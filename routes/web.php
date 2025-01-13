<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/jewelry/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/jewelry/{category:slug}/{jewelry:slug}', [FrontController::class, 'detail'])->name('front.detail');
Route::get('/tes', function () {
    return view('front.cart1');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{jewelry:id}', [CartController::class, 'cartAdd'])->name('cart.add');

    Route::post('/cart/checkout', [FrontController::class, 'checkout'])
    ->name('checkout.add')
    ->block($lockSeconds = 5, $waitSeconds = 10);

    Route::post('/cart/checkoutProcess', [FrontController::class, 'checkoutProcess'])
    ->name('front.checkoutProcess');

    // Payment routes
    Route::get('/payment/thank-you/{uniqueTrxId}', [FrontController::class, 'payment'])->name('front.payment');
    Route::patch('/payment/{uniqueTrxId}/save', [FrontController::class, 'paymentStore'])->name('front.paymentStore');

});
