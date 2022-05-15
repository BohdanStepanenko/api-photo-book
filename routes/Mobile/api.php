<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\UserController;
use App\Http\Controllers\Mobile\OrderController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [UserController::class, 'show']);
    Route::put('profile', [UserController::class, 'update']);
    Route::get('order/{id}', [OrderController::class, 'show']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::apiResource('books', BookController::class);
    Route::apiResource('photos', PhotoController::class);
    Route::apiResource('covers', CoverController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('payment-methods', PaymentMethodController::class);
});
