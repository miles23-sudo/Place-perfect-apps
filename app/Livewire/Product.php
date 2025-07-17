<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public $slug;

    #[Computed]
    public function product()
    {
        return ProductModel::where('slug', $this->slug)->firstOrFail();
    }

    #[Computed]
    public function productRecommendations()
    {
        return ProductModel::where('id', '!=', $this->product->id)
            ->inRandomOrder()
            ->limit(8)
            ->get();
    }

    public function render()
    {
        return view('livewire.product');
    }
}
