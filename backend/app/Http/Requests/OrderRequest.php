<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "phone" => 'required|size:10',
            "phone_reception" => 'required|size:10',
            "sender_name" => 'required',
            "shipping_address" => 'required',
            "recipient_address" => 'required',
            "province_shipping_id" => 'required',
            "province_recipient_id" => 'required',
            "product_name" => 'required',
            "shipping_fee" => 'required',
            "weight" => 'required|numeric',
        ];
    }
}
