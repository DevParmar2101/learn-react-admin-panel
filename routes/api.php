<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
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
            Route::post('/index', [UserController::class, 'index']);
            Route::post('/create', [UserController::class, 'store']);
            Route::get('/view/{user}',[UserController::class, 'show']);
            Route::put('/update/{user}', [UserController::class, 'update']);
            Route::delete('/delete/{user}', [UserController::class, 'destroy']);
            Route::patch('/restore/{user}', [UserController::class, 'restore']);
        });

        Route::prefix('customers')->group(function () {
            Route::post('/index', [CustomerController::class, 'index']);
            Route::post('/create', [CustomerController::class, 'store']);
        });

    });
});
