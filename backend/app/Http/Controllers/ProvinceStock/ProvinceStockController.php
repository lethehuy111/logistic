<?php

namespace App\Http\Controllers\ProvinceStock;

use App\Globals\Constants;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinceStock\ProvinceStockResource;
use App\Models\ProvinceStock;

class ProvinceStockController extends Controller
{
    public function index()
    {
        $provinces = ProvinceStock::all();

        return response()->json([
            'return' => Constants::RESPONSE_SUCCESS,
            'result' => ProvinceStockResource::collection($provinces)
        ]);
    }
}
