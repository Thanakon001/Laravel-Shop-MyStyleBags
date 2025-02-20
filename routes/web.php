<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptPayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('api/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// Route::get('/promptpay/{amount}', [PromptPayController::class, 'generateQr']);

Route::middleware(['auth', 'admin', 'throttle:20,1'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/order', [HomeController::class, 'order'])->name('order');
    Route::get('/order/success', [HomeController::class, 'ordersuccess'])->name('order.success');
    Route::get('/order/cancel', [HomeController::class, 'ordercancel'])->name('order.cancel');
    Route::get('/product', [HomeController::class, 'product'])->name('product');
    Route::get('/band', [HomeController::class, 'band'])->name('band');
    Route::get('/cutomer', [HomeController::class, 'cutomer'])->name('cutomer');

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/profile/cutmomer/{id}', [HomeController::class, 'cutomer_profile'])->name('cutomer.profile');
    Route::put('/profile/cutmomer/ban/{id}', [AuthController::class, 'ban_user'])->name('cutomer.profile.ban');

    Route::get('/product/add', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');

    Route::get('/band/add', [BandController::class, 'create'])->name('band.create');
    Route::get('/band/edit/{id}', [BandController::class, 'edit'])->name('band.edit');
    Route::put('/band/update/{id}', [BandController::class, 'update'])->name('band.update');
    Route::get('/band/delete/{id}', [BandController::class, 'destroy'])->name('band.delete');
    Route::post('/band', [BandController::class, 'store'])->name('band.store');

    Route::get('/order/perpare/{id}', [OrderController::class, 'index_perpare'])->name('order.perpare');
    Route::put('/order/perpare/{id}', [OrderController::class, 'store_perpare'])->name('order.perpare.store');
});

Route::middleware(['auth', 'throttle:200,1'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.admin');
    Route::post('/profile', [HomeController::class, 'updateprofile'])->name('profile.user.update');
    Route::get('/shop/payments', [ShopController::class, 'payments'])->name('shop.payments');
    Route::post('/shop/cart/add/{id}', [CartController::class, 'addItem'])->name('shop.cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'updateItem'])->name('shop.cart.update');
    Route::delete('/shop/cart/remove/{id}', [CartController::class, 'removeItem'])->name('shop.cart.remove');
    Route::post('/shop/order', [OrderController::class, 'store'])->name('shop.order.store');
    Route::get('/shop/order/history', [ShopController::class, 'history'])->name('shop.order.history');
    Route::get('/shop/order/check/{id}', [ShopController::class, 'orderstatus'])->name('shop.order.check');
    Route::post('/shop/order/check/edit', [OrderController::class, 'edit'])->name('shop.order.edit');
    Route::get('/shop/user', [ShopController::class, 'profile'])->name('shop.profile');
    Route::post('/shop/rating', [RatingController::class, 'store'])->name('shop.rating.store');
});

Route::middleware(['throttle:20,1'])->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/product', [ShopController::class, 'product'])->name('shop.product');
    Route::post('/shop/product', [ShopController::class, 'productsearch'])->name('shop.product.search');
    Route::get('/shop/product/{id}', [ShopController::class, 'details'])->name('shop.details');
    Route::get('/shop/about', [ShopController::class, 'about'])->name('shop.about');
    Route::get('/shop/contact', [ShopController::class, 'contact'])->name('shop.contact');
    Route::get('/shop/cart', [ShopController::class, 'cart'])->name('shop.cart');
});

Route::get('/', function () {
    return redirect()->route('shop.index');
});

Route::get('/test', function () {
    $order = App\Models\Order::with('orderList.product')->find('T2025022000001');
    return view('mail.orderMail', compact('order'));
});

