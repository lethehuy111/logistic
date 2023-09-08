<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceStock extends Model
{
    protected $table="province_stocks";
    protected $fillable = [
        'name',
        'point_x',
        'point_y',
        'type'
    ];
}
