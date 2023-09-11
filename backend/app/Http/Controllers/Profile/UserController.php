<?php

namespace App\Http\Controllers\Profile;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Profile\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     * @throws BusinessException
     */
    public function index() :JsonResponse
    {
        $user = auth()->user();

        if (!isset($user)) {
            throw new BusinessException('User not found', Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new UserResource($user));
    }
}
