<?php

namespace App\Http\Controllers\Order;

use App\Globals\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\ShippingFee;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\CommonService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $repository;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function index(Request $request) {
        $params = [
            'keyword' => $request->get('keyword' || '')
        ];

        $result = $this->repository->getList($params);

        return response()->json([
            'return' => Constants::RESPONSE_SUCCESS,
            'result' => OrderResource::collection($result)
        ]);
    }

    public function store(OrderRequest $request) {
        $params = $request->all();
        $this->repository->store($params);

        return response()->json(new EmptyResource([]));
    }

    public function getPriceWeight(Request $request) {
        $weight = $request->get('weight');
        $reception_id = $request->get("province_shipping_id");
        $shipping_id  =   $request->get("province_recipient_id");
        $fee = ShippingFee::where('weight' , '>=' , (int)$weight)->orderBy('weight')->first();

        $shippingFee = ($fee->price_point ?? 30000) * CommonService::getDistance($reception_id, $shipping_id);
        return response()->json([
           'return' => Constants::RESPONSE_SUCCESS,
           "result" => [
               "shipping_fee" => $shippingFee
           ]
        ]);
    }

    public function confirm(Request $request) {
        $params = $request->all();
        $result = $this->repository->confirm($params);

        return response()->json(new EmptyResource([]));
    }

    public function update(Request $request) {
        $params = $request->all();
        $result = $this->repository->confirm($params);

        return response()->json(new EmptyResource([]));
    }
}
