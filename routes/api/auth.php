<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('send-otp/{user:id}', [OtpController::class, 'send']);
        Route::post('verify-otp', [OtpController::class, 'verify']);
    });
});


