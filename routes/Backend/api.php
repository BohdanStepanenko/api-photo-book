<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BookController;

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::get('books', [BookController::class, 'index']);
    });
});
