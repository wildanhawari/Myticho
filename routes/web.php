<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/',action: [FrontController::class, 'index'])->name('front.index');


Route::get('/jewelry/{category:slug}',action: [FrontController::class, 'category'])->name('front.category');

Route::get('/cart',action: [FrontController::class, 'cart'])->name('front.cart');
