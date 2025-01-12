<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/







Route::prefix('v1/')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('cutomer-login', [AuthController::class, 'CustomerLogin']);
    Route::post('otp-verify', [AuthController::class, 'verifyOtp']);

    Route::get('categories', [ProductController::class, 'Categories']);
    Route::get('books', [ProductController::class, 'books']);
    Route::get('book/{id}', [ProductController::class, 'show']);
});

Route::prefix('v1/')->middleware('jwt.verfy')->group(function () {
    Route::get('delivery-addresses', [OrderController::class, 'fetchDeliveryAddresses']);
    Route::post('delivery-addresses', [OrderController::class, 'createDeliveryAddress']);
    Route::put('delivery-addresses/{id}', [OrderController::class, 'updateDeliveryAddress']);
    Route::post('orders', [OrderController::class, 'placeOrder']);
    Route::post('logout', [AuthController::class, 'logout']);
});
