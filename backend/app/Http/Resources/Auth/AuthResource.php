<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'return' => true,
            'result' => [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email,
                "email_verified_at" => $this->email_verified_at,
                "role" => $this->role,
                "stock_id" => $this->stock_id,
                "status" => $this->status,
            ],
            'authorisation' => [
                'token' => $this->token
            ]
        ];
    }
}
