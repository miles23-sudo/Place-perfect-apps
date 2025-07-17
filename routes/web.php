<?php

use App\Livewire\Categories;
use App\Livewire\Shop;
use App\Livewire\Product;
use App\Livewire\Home;

Route::get('/', Home::class)->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/product/{slug}', Product::class)->name('product');
Route::get('/categories', Categories::class)->name('categories');
