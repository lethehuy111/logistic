<?php

namespace App\Models;

use App\Globals\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $table="orders";

    protected $fillable=[
        "order_num",
        "user_created_id",
        "phone",
        "phone_reception",
        "sender_name",
        "recipienter_name",
        "shipping_date",
        "expected_date",
        "shipping_address",
        "recipient_address",
        "province_shipping_id",
        "province_recipient_id",
        "product_name",
        "shipping_fee",
        "weight",
        "status",
        "note"
    ];

    public function userCreated(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_created_id', 'id');
    }

    public function provinceShipping(): BelongsTo
    {
        return $this->belongsTo(ProvinceStock::class, 'province_shipping_id', 'id');
    }

    public function provinceRecipient(): BelongsTo {
        return $this->belongsTo(ProvinceStock::class, 'province_recipient_id', 'id');
    }

    public function orderProcess(): HasMany
    {
        return $this->hasMany(OrderProcess::class, 'order_id', 'id');
    }

    public function currentOrderProcess(): HasOne
    {
        return $this->hasOne(OrderProcess::class, 'order_id', 'id')
            ->where("status", Constants::STATUS_PROCESS_PROCESSING);
    }

    public function nextOrderProcess(): HasOne
    {
        return $this->hasOne(OrderProcess::class, 'order_id', 'id')
            ->where("status", Constants::STATUS_PROCESS_OPEN);
    }
    public function rate(): HasOne
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
