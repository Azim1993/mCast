<?php

use App\Data\Enums\TokenTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('refresh/token', [\App\Http\Controllers\AuthController::class, 'refreshToken'])
    ->middleware([
        'auth:sanctum',
        "ability:". TokenTypeEnum::REFRESH_TOKEN->value
    ]);

Route::middleware(['auth:sanctum', "ability:". TokenTypeEnum::API_TOKEN->value])->group(function() {
    Route::delete('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::prefix('users')->group(function() {
        Route::post('{userId}/follow', [\App\Http\Controllers\UserController::class, 'follow']);
        Route::post('{userId}/unfollow', [\App\Http\Controllers\UserController::class, 'unfollow']);

        Route::get('', [\App\Http\Controllers\UserController::class, 'getUsers']);
        Route::get('{userId}', [\App\Http\Controllers\UserController::class, 'getDetail']);
    });

    Route::prefix('timelines')->group(function() {
        Route::get('', [\App\Http\Controllers\TimelineController::class, 'getTimelines']);
        Route::get('{timelineId}', [\App\Http\Controllers\TimelineController::class, 'getTimelineDetail']);
        Route::post('', [\App\Http\Controllers\TimelineController::class, 'storeTimeline']);
        Route::post('{timelineId}/reaction', [\App\Http\Controllers\TimelineController::class, 'toggleReaction']);
        Route::post('{timelineId}/comment', [\App\Http\Controllers\TimelineController::class, 'storeComment']);
    });
});
