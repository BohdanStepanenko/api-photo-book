<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::put('user', [UserController::class, 'update']);
        Route::delete('user/{id}', [UserController::class, 'destroy']);
    });
});
