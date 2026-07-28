<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/update-profile', [AuthController::class, 'updateProfile']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('change-password', [AuthController::class,'changePassword']);

        Route::prefix('users')->group(function () {
            Route::post('/', [UserController::class, 'store']);
        });
    });
});
