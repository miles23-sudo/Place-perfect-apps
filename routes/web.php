<?php

use App\Livewire;
use App\Http\Controllers\Api\PaymentCallbackController;

Route::get('/', Livewire\Home::class)->name('home');
Route::get('/shop', Livewire\Shop::class)->name('shop');
Route::get('/product/{slug}', Livewire\Product::class)->name('product');
Route::get('/contact-us', Livewire\ContactUs::class)->name('contact-us');
Route::get('/wishlist', Livewire\Wishlist::class)
    ->middleware('customer-authenticate')
    ->name('wishlist');
Route::get('/cart', Livewire\Cart::class)->name('cart');
Route::get('/checkout', Livewire\Checkout::class)
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
