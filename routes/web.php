<?php

use App\Livewire;

Route::get('/', Livewire\Home::class)->name('home');
Route::get('/shop', Livewire\Shop::class)->name('shop');
Route::get('/product/{slug}', Livewire\Product::class)->name('product');
Route::get('/contact-us', Livewire\ContactUs::class)->name('contact-us');
Route::get('/shipping-method', Livewire\ShippingMethod::class)->name('shipping-method');
Route::get('/payment-method', Livewire\PaymentMethod::class)->name('payment-method');

Route::name('auth.')->middleware('guest.customer')->group(function () {
    Route::get('/login', Livewire\Auth\Login::class)->name('login');
    Route::get('/register', Livewire\Auth\Register::class)->name('register');
});

Route::name('customer.')->middleware('authenticated.customer')->group(function () {
    Route::get('/account', Livewire\Customer\Account::class)->name('account');
    Route::get('/order', Livewire\Customer\Order::class)->name('order');
    Route::get('/wishlist', Livewire\Customer\Wishlist::class)->name('wishlist');
    Route::post('/logout', Livewire\Auth\Logout::class)->name('logout');
    Route::get('/cart', Livewire\Customer\Cart::class)->name('cart');
    Route::get('/checkout', Livewire\Customer\Checkout::class)->name('checkout');
    Route::get('/order-placed/{id}', Livewire\Customer\OrderPlaced::class)->name('order-placed');
});
