<?php

use App\Livewire\Shop;
use App\Livewire\Product;
use App\Livewire\Home;
use App\Livewire\ContactUs;
use App\Livewire\Categories;
use App\Livewire\Auth\CustomerLogin;

Route::get('/', Home::class)->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/product/{slug}', Product::class)->name('product');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/contact-us', ContactUs::class)->name('contact-us');

Route::get('/get-started', CustomerLogin::class)->name('customer.login');
