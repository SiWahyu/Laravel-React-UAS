<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [App\Http\Controllers\Api\DashboardController::class, 'index']);
Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('suppliers', \App\Http\Controllers\Api\SupplierController::class);
Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/user', [App\Http\Controllers\Api\AuthController::class, 'user']);
});
