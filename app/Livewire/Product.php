<?php

namespace App\Livewire;

use App\Filament\Customer\Pages\Auth\Login;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Settings\Shipping;
use App\Models\Wishlist;
use App\Models\Product as ProductModel;
use App\Models\Cart;

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

    public function addToWishlist()
    {
        if (!auth('customer')->check()) {
            return $this->redirectIntended(filament()->getPanel('customer')->getLoginUrl());
        }

        Wishlist::updateOrCreate([
            'customer_id' => auth('customer')->id(),
            'product_id' => $this->product->id
        ]);

        $this->dispatch("wishlist-refresh");

        notyf('Product added to wishlist successfully!');
    }


    #[Computed]
    public function product()
    {
        return ProductModel::isActive()
            ->whereSlug($this->slug)
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

    #[Computed]
    public function shippingDeliveryTermsSetting()
    {
        return app(Shipping::class)->delivery_terms;
    }

    public function render()
    {
        return view('livewire.product');
    }
}
