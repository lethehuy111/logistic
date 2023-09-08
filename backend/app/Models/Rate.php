<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rate extends Model
{
    protected $table = "rates";

    protected $fillable = [
        'order_id',
        'rate',
        'comment'
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'order_id', 'id');
    }
}
