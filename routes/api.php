<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CilentProduct;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::post('/singup', [AuthController::class, 'singup']);
Route::post('/singin', [AuthController::class, 'singin']);

Route::get('/product/cilent/{id}', [ProductController::class, 'show']);

