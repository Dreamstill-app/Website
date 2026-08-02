<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BundleController;
use App\Http\Controllers\Api\V1\ChallengeController;
use App\Http\Controllers\Api\V1\ChatController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\FactController;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\ImpactController;
use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\MeController;
use App\Http\Controllers\Api\V1\RewardController;
use App\Http\Controllers\Api\V1\SortController;
use App\Http\Controllers\Api\V1\SortImageController;
use App\Http\Controllers\Api\V1\TipController;
use App\Http\Controllers\Api\V1\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {

    // --- Public ----------------------------------------------------------
    Route::get('/health', HealthController::class);
    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/facts/random', [FactController::class, 'random']);
    Route::get('/impact/global', [ImpactController::class, 'global']);
    Route::get('/tips', [TipController::class, 'index']);

    // --- Auth (unauthenticated, tight throttle) ---------------------------
    Route::middleware('throttle:api-auth')->prefix('auth')->group(function (): void {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/guest', [AuthController::class, 'guest']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    });

    // --- Authenticated ----------------------------------------------------
    Route::middleware('auth:sanctum')->group(function (): void {

        Route::prefix('auth')->group(function (): void {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/logout-all', [AuthController::class, 'logoutAll']);
            Route::post('/guest/upgrade', [AuthController::class, 'guestUpgrade']);
        });

        Route::get('/me', [MeController::class, 'show']);
        Route::patch('/me', [MeController::class, 'update']);
        Route::delete('/me', [MeController::class, 'destroy']);
        Route::post('/me/avatar', [MeController::class, 'avatar']);
        Route::get('/me/avatar', [MeController::class, 'avatar']);

        Route::get('/sorts', [SortController::class, 'index']);
        Route::post('/sorts', [SortController::class, 'store'])->middleware('throttle:api-analyze');
        Route::get('/sorts/{sort}', [SortController::class, 'show']);
        Route::patch('/sorts/{sort}', [SortController::class, 'update']);
        Route::delete('/sorts/{sort}', [SortController::class, 'destroy']);
        Route::get('/sorts/{sort}/images/{type}', SortImageController::class)
            ->whereIn('type', ['front', 'back', 'tag']);

        Route::get('/bundles', [BundleController::class, 'index']);
        Route::post('/bundles', [BundleController::class, 'store']);
        Route::patch('/bundles/{bundle}', [BundleController::class, 'update']);
        Route::delete('/bundles/{bundle}', [BundleController::class, 'destroy']);
        Route::post('/bundles/{bundle}/items', [BundleController::class, 'addItem']);
        Route::delete('/bundles/{bundle}/items/{sort}', [BundleController::class, 'removeItem']);

        Route::post('/events/submit', [EventController::class, 'submit']);

        Route::get('/challenges', [ChallengeController::class, 'index']);
        Route::post('/challenges/{challenge}/join', [ChallengeController::class, 'join']);

        Route::get('/rewards', [RewardController::class, 'index']);
        Route::post('/rewards/{reward}/claim', [RewardController::class, 'claim']);

        Route::post('/tips', [TipController::class, 'store']);
        Route::get('/users/{user}/profile', [UserProfileController::class, 'show']);

        Route::get('/impact/me', [ImpactController::class, 'me']);

        Route::middleware('throttle:api-chat')->group(function (): void {
            Route::post('/chat', [ChatController::class, 'send']);
        });
        Route::get('/chat/conversations', [ChatController::class, 'conversations']);
        Route::get('/chat/conversations/{conversation}', [ChatController::class, 'messages']);
    });
});
