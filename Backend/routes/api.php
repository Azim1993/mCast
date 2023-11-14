<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::delete('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::prefix('users')->group(function() {
        Route::post('{userId}/follow', [\App\Http\Controllers\UserController::class, 'follow']);
        Route::post('{userId}/unfollow', [\App\Http\Controllers\UserController::class, 'unfollow']);

        Route::get('', [\App\Http\Controllers\UserController::class, 'getDetail']);
    });
});
