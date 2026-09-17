<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sanctum/token', LoginController::class);

// Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
   Route::apiResource('orders', OrderController::class);
   Route::get('/customers', [CustomerController::class, 'index']);
   Route::get('/customers/{customer}', [CustomerController::class, 'show']);
});
// Route::get('/orders', [OrderController::class, 'index']);
// Route::post('/orders', [OrderController::class, 'store']);
// Route::get('/orders/{order}', [OrderController::class, 'show']);
// Route::put('/orders/{order}', [OrderController::class, 'update']);
// Route::delete('/orders/{order}', [OrderController::class, 'destroy']);


