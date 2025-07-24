<?php

namespace App\Livewire;

use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\ProductCategory;

class Categories extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Computed]
    public function productCategories()
    {
        // Logic to fetch product categories can be added here
        return ProductCategory::isActive()
            ->paginate(6);
    }


    public function render()
    {
        return view('livewire.categories');
    }
}
