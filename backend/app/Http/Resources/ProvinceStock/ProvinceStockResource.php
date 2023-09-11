<?php

namespace App\Http\Resources\ProvinceStock;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 */
class ProvinceStockResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}
