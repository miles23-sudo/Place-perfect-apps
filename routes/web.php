<?php

use App\Livewire\Shop;
use App\Livewire\Product;
use App\Livewire\Home;
use App\Livewire\ContactUs;
use App\Livewire\Cart;
use App\Http\Controllers\Payments\CheckoutController;
use App\Http\Controllers\Api\PaymongoPaymentStatusController;

Route::get('/', Home::class)->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/product/{slug}', Product::class)->name('product');
Route::get('/contact-us', ContactUs::class)->name('contact-us');
Route::get('/cart', Cart::class)->name('cart');

// -------------------------------------------------------
// Paymongo Webhook and Order Routes
// -------------------------------------------------------
Route::get('/payment/{order_number}', [PaymongoPaymentStatusController::class, 'handle'])
    ->name('payment.status');
