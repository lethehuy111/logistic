<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    protected $table='shipping_frees';

    protected $fillable = [
        'weight',
        'price_point'
    ];
}
