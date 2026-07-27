<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'User successfully registered',
            'data' => new UserResource($user)
        ], 201);
    }

    /**
     * Login User
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'user' => new UserResource($data['user']),
                'token' => $data['token'],
            ],
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function userProfile()
    {
        return response()->json([
            'success' => true,
            'message' => 'Authenticated user fetched successfully.',
            'data' => new UserResource(Auth::user()),
        ]);
    }
}
