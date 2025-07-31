<?php

use App\Livewire\Shop;
use App\Livewire\Product;
use App\Livewire\Home;
use App\Livewire\ContactUs;
use App\Livewire\Cart;
use App\Http\Controllers\Api\PaymongoWebhookController;
use App\Http\Controllers\Api\PaymongoPaymentSuccessController;

Route::get('/', Home::class)->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/product/{slug}', Product::class)->name('product');
Route::get('/contact-us', ContactUs::class)->name('contact-us');
Route::get('/cart', Cart::class)->name('cart');

// -------------------------------------------------------
// Paymongo Webhook and Order Success Routes
// -------------------------------------------------------
Route::get('/payment/success/{order_number}', [PaymongoPaymentSuccessController::class, 'handle'])
    ->name('payment.success');
