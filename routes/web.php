<?php

use App\Livewire\Shop;
use App\Livewire\Product;
use App\Livewire\Home;
use App\Livewire\ContactUs;
use App\Livewire\Categories;
use App\Livewire\Auth\CustomerRegister;
use App\Livewire\Auth\CustomerProfile;
use App\Livewire\Auth\CustomerLogin;

Route::get('/', Home::class)->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/product/{slug}', Product::class)->name('product');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/contact-us', ContactUs::class)->name('contact-us');

Route::name('auth.')->prefix('auth')->middleware('guest')->group(function () {
    Route::get('/login', CustomerLogin::class)->name('login');
    Route::get('/register', CustomerRegister::class)->name('register');
});

Route::name('customer.')->prefix('customer')->middleware(['customer-authenticate'])->group(function () {
    Route::get('/profile', CustomerProfile::class)->name('profile');
    // Logout route
    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('home')->with('message', 'You have been logged out.');
    })->name('logout');
});
