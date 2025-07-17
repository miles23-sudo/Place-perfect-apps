<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\ProductCategory;

class Categories extends Component
{
    #[Computed]
    public function productCategories()
    {
        // Logic to fetch product categories can be added here
        return ProductCategory::isActive()
            ->get();
    }


    public function render()
    {
        return view('livewire.categories');
    }
}
