<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Shop;
use App\Livewire\Home;

Route::get('/', Home::class)->name('home');

Route::get('/shop', Shop::class)->name('shop');
