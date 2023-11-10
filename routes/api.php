<?php

use App\Http\Controllers\api\v1\AuthenticationController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\CheckoutController;
use App\Http\Controllers\api\v1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('product', ProductController::class);
Route::apiResource('category', CategoryController::class);

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook', [CheckoutController::class, 'webhook'])->name('webhook');
Route::post('/user/login', [AuthenticationController::class, 'login']);
Route::post('/user/logout', [AuthenticationController::class, 'logout']);
Route::post('/user/regester', [AuthenticationController::class, 'regester']);
