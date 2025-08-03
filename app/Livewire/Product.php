<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Models\Product as ProductModel;
use App\Models\Cart;
use App\Livewire\Cart as CartLivewire;

class Product extends Component
{
    public $slug;

    #[Validate('required|integer|min:1|max:100')]
    public $quantity = 1;

    public function addToCart()
    {
        $this->validate();

        Cart::addOrUpdate($this->product->id, $this->quantity);

        $this->dispatch("cart-refresh");

        notyf('Product added to cart successfully!');
    }

    #[Computed]
    public function product()
    {
        return ProductModel::isActive()
            ->where('slug', $this->slug)
            ->firstOrFail();
    }

    #[Computed]
    public function productFeedbacks()
    {
        return $this->product->feedbacks()
            ->latest()
            ->paginate(5);
    }

    #[Computed]
    public function productRecommendations()
    {
        return ProductModel::isActive()
            ->where('id', '!=', $this->product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.product');
    }
}
