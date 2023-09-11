<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Http\Resources\EmptyResource;
use App\Models\Rate;

class RateController extends Controller
{
    public function store(RateRequest $request)
    {
        Rate::create($request->all());

        return response()->json(new EmptyResource([]));
    }
}
