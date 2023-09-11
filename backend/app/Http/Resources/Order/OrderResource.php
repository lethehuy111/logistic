<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "order_num" => $this->order_num,
            "user_created_id" => $this->user_created_id,
            "phone" => $this->phone,
            "customer_name" => $this->customer_name,
            "shipping_date" => $this->shipping_date,
            "expected_date" => $this->expected_date,
            "shipping_address" => $this->shipping_address,
            "recipient_address" => $this->recipient_address,
            "province_shipping_id" => $this->province_shipping_id,
            "province_recipient_id" => $this->province_recipient_id,
            "product_name" => $this->product_name,
            "shipping_fee" => $this->shipping_fee,
            "weight" => $this->weight,
            "status" => $this->status,
            "current_process" => $this->currentOrderProcess,
            "next_process" => $this->nextOrderProcess,
            "rate" => $this->rate
        ];
    }
}
