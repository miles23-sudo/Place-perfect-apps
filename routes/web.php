<?php

use App\Livewire\Shop;
use App\Livewire\Product;
use App\Livewire\Home;
use App\Livewire\ContactUs;
use App\Livewire\Checkout;
use App\Livewire\Cart;
use App\Http\Controllers\Api\PaymentCallbackController;

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

Route::name('handle-payment.')->prefix('payment')->group(function () {
    Route::get('/online/{order_number}', [PaymentCallbackController::class, 'handleOnline'])
        ->middleware('customer-authenticate')
        ->name('online');

    Route::get('/cod/{order_number}', [PaymentCallbackController::class, 'handleCOD'])
        ->middleware('customer-authenticate')
        ->name('cod');
});
