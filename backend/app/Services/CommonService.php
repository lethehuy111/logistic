<?php

namespace App\Services;

use App\Globals\Constants;
use App\Models\ProvinceStock;

class CommonService
{
    public static function getDistance($reception_id, $shipping_id): float
    {
        $provinces = ProvinceStock::whereIn('id', [$reception_id, $shipping_id])->get()->toArray();

        if (count($provinces) == 1) return 1 ;

        $reception = [
            'point_x' => $provinces[0]['point_x'],
            'point_y' => $provinces[0]['point_y'],
        ];

        $shipping = [
            'point_x' => $provinces[1]['point_x'],
            'point_y' => $provinces[1]['point_y'],
        ];

        $distance =  round(
            sqrt
            (pow($reception['point_x'] - $shipping['point_x'], 2) +
                  pow($reception['point_y'] - $shipping['point_y'], 2)
            )
        );
        return $distance == 0 ? 1 : $distance;
    }
}
