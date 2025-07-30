<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\ProductCategory;
use App\Models\Product;

class Home extends Component
{
    #[Computed]
    public function productCategories()
    {
        return ProductCategory::isActive()
            ->withCount(['products as products_count' => function ($query) {
                $query->isActive();
            }])
            ->with(['products' => fn($query) => $query->isActive()])
            ->get();
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
