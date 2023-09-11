<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\Profile\UserResource;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @var AuthRepositoryInterface
     */
    private $repository;

    /**
     * @param AuthRepositoryInterface $repository
     */
    public function __construct(AuthRepositoryInterface $repository)
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
        $this->repository = $repository;
    }
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
    /**
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = $this->repository->login($credentials);

        return response()->json(new AuthResource($user));

    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->repository->logout();

        return response()->json(new EmptyResource([]));
    }
}
