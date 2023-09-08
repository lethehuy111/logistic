<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class OrderProcess extends Model
{
    /**
     * @var string
     */
    protected $table="order_process";

    /**
     * @var string[]
     */
    protected $fillable = [
        "order_id",
        "employee_assign_id",
        "stock_id",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function ProvinceStock(): BelongsTo
    {
        return $this->belongsTo(ProvinceStock::class, 'stock_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order', 'id');
    }

}
