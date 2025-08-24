<?php

use App\Livewire;

Route::get('/', Livewire\Home::class)->name('home');
Route::get('/shop', Livewire\Shop::class)->name('shop');
Route::get('/product/{slug}', Livewire\Product::class)->name('product');
Route::get('/contact-us', Livewire\ContactUs::class)->name('contact-us');
Route::get('/shipping-method', Livewire\ShippingMethod::class)->name('shipping-method');
Route::get('/payment-method', Livewire\PaymentMethod::class)->name('payment-method');
