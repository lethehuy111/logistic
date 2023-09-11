<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmptyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'return' => true,
            'result' => []
        ];
    }
}
