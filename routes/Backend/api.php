<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('users', [AdminController::class, 'index']);
    });
});
