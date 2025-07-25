<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Cart;

class Home extends Component
{
    public function addItemToCart($productId)
    {
        Cart::addOrUpdate($productId);

        notyf('Product added to cart successfully!');
    }

    #[Computed]
    public function productCategories()
    {
        return ProductCategory::isActive()->limit(3)->get();
    }

    #[Computed]
    public function products()
    {
        return Product::isActive()->limit(8)->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
