<?php

use App\Livewire\Shop;
use App\Livewire\Product;
use App\Livewire\Home;
use App\Livewire\ContactUs;
use App\Livewire\Checkout;
use App\Livewire\Cart;
use App\Http\Controllers\Api\PaymongoPaymentStatusController;

Route::get('/', Home::class)->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/product/{slug}', Product::class)->name('product');
Route::get('/contact-us', ContactUs::class)->name('contact-us');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)
    ->middleware('customer-authenticate')
    ->name('checkout');

// -------------------------------------------------------
// Paymongo Webhook and Order Routes
// -------------------------------------------------------
Route::get('/payment/{order_number}', [PaymongoPaymentStatusController::class, 'handle'])
    ->name('payment.status');
