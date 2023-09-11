<?php

namespace App\Repositories\Order;

use App\Exceptions\BusinessException;
use App\Globals\Constants;
use App\Models\Order;
use App\Models\OrderProcess;
use App\Models\ProvinceStock;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\CommonService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected $orderProcess;
    protected $provinceStock;

    protected $user;

    public function __construct(Order $model, OrderProcess $orderProcess, ProvinceStock $provinceStock, User $user)
    {
        $this->model = $model;
        $this->orderProcess = $orderProcess;
        $this->provinceStock = $provinceStock;
        $this->user = $user;
    }

    public function getList(array $params)
    {
        $keyword = $params['keyword'];
        $user = auth()->user();
        $sql = $this->model->with([
            'orderProcess', 'provinceShipping', 'provinceRecipient', 'currentOrderProcess', 'nextOrderProcess'
        ]);
        if ($keyword) {
            $sql = $sql->where(function ($q) use ($keyword) {
                $q->where('order_num', $keyword)
                    ->orWhere('customer_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('shipping_date', $keyword);
            });
        }
        if ($user->role === Constants::ROLE_CUSTOMER) {
            $sql = $sql->where('user_created_id', $user->id);
        } else {
            $sql = $sql->whereHas('orderProcess', function ($q) use ($user) {
                $q->whereIn('status', [Constants::STATUS_PROCESS_DONE, Constants::STATUS_PROCESS_PROCESSING])
                    ->where('employee_assign_id', $user->id);
            });
        }

        return $sql->get()->sortBy('orderProcess.status')->sortByDesc('created_at');
    }

    public function store(array $params): array
    {
        $date = Carbon::now();
        $params['expected_date'] = $date->addDays(Constants::EXPECTED_DATE);
        try {
            DB::beginTransaction();
            $params['order_num'] = $this->genOrderNumber();
            $params['user_created_id'] = auth()->user()->id;
            $orderId = $this->model->insertGetId($params);
            $provinceId = $params['province_recipient_id'];

            $user = $this->user->where('stock_id', $provinceId)->where('role', Constants::ROLE_EMPLOYEE)->first();
            $this->orderProcess->create([
                "order_id" => $orderId,
                "employee_assign_id" => $user->id,
                "stock_id" => $provinceId,
                "status" => Constants::STATUS_PROCESS_PROCESSING
            ]);
            DB::commit();
            return [];
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getLine(), $e->getFile());
            $this->store($params);
        }
    }

    /**
     * @throws BusinessException
     */
    public function confirm(array $params): array
    {
        $orderId = $params['order_id'];
        $status = (int)$params['status'];
        $order = $this->model->find((int)$orderId);
        if (!$order) {
            throw new BusinessException('Order not found', Response::HTTP_BAD_REQUEST);
        }
        if ($status === Constants::STATUS_REJECTED) {
            $order->status = Constants::STATUS_REJECTED;
            return [];
        }
        try {
        DB::beginTransaction();
        $order->status = Constants::STATUS_PROCESSING;
        $order->save();
        $currentOrderProcess = $order->currentOrderProcess()->update(['status' => Constants::STATUS_PROCESS_DONE]);

        $provinceProcessIds = $this->getProcessOrder($order);
        foreach ($provinceProcessIds as $key => $provinceId) {
            $userEmployee = $this->user->where('role', Constants::ROLE_EMPLOYEE)->where('stock_id', $provinceId)->first();
            $userShipper = $this->user->where('role', Constants::ROLE_SHIPPER)->where('stock_id', $provinceId)->first();
            if ($key == 0) {
                $this->orderProcess->create([
                    "order_id" => $orderId,
                    "employee_assign_id" => $userShipper->id,
                    "stock_id" => $provinceId,
                    "status" => Constants::STATUS_PROCESS_PROCESSING
                ]);
            }
            $this->orderProcess->create([
                "order_id" => $orderId,
                "employee_assign_id" => $userEmployee->id,
                "stock_id" => $provinceId,
                "status" => Constants::STATUS_PROCESS_OPEN
            ]);
            if ($key === count($provinceProcessIds) - 1) {
                $this->orderProcess->create([
                    "order_id" => $orderId,
                    "employee_assign_id" => $userShipper->id,
                    "stock_id" => $provinceId,
                    "status" => Constants::STATUS_PROCESS_OPEN,
                    "type" => Constants::TYPE_END_PROCESS
                ]);
            }
        }
        DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getLine(), $e->getFile());
            throw new BusinessException('Update process order fail', Response::HTTP_BAD_REQUEST);
        }

        return [];
    }

    public function updateProcess(array $params)
    {
        $orderId = $params['order_id'];
        $order = $this->model->find((int)$orderId);
        if (!$order) {
            throw new BusinessException('Order not found', Response::HTTP_BAD_REQUEST);
        }
        DB::beginTransaction();
        try {
            $order->currentOrderProcess()->update(['status' => Constants::STATUS_PROCESS_DONE]);
            $nexProcess = $order->nextOrderProcess;
            $currentProcess = $order->currentOrderProcess;
            if (!$nexProcess && $currentProcess->type == Constants::TYPE_END_PROCESS) {
                $order->status = Constants::STATUS_DONE;

                return [];
            }
            $order->nextOrderProcess()->update(['status' => Constants::STATUS_PROCESS_PROCESSING]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new BusinessException('Update process order fail', Response::HTTP_BAD_REQUEST);
        }

        return [];
    }

    private function genOrderNumber(): string
    {
        return Str::random(12);
    }

    private function getProcessOrder(object $order) {
        $provinceRecipient = $order->province_recipient_id;
        $provinceShippingId = $order->province_shipping_id;
        if ($provinceRecipient == $provinceShippingId) {
            return [$order->province_recipient_id];
        }

        $provinceStocks = $this->provinceStock->where('type' , Constants::TYPE_STOCK)->get()->keyBy('id')->toArray();
        $transitStocks = array_keys($provinceStocks);

        if (array_intersect($transitStocks, [$provinceRecipient, $provinceShippingId])) {
            return [$provinceShippingId , $provinceRecipient];
        }
        $minDistance = 0;
        $transitStockId = null;
        foreach ($provinceStocks as $key => $provinceStock) {
            $distance = CommonService::getDistance($provinceStock['id'] , $provinceRecipient) +
                CommonService::getDistance($provinceStock['id'] , $provinceShippingId);

            if (!$transitStockId || $distance < $minDistance) {
                $minDistance = $distance;
                $transitStockId = $provinceStock['id'];
            }
        }

        return [ $provinceRecipient, $transitStockId , $provinceShippingId];
    }
}
