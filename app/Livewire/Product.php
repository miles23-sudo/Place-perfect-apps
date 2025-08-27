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
        if (!auth('customer')->check()) {
            return $this->redirect(route('auth.login'));
        }

        $this->validate();

        auth('customer')->user()->cart()->updateOrCreate(
            ['product_id' => $this->product->id],
            [
                'quantity' => $this->quantity,
                'price' => $this->product->price
            ]
        );

        $this->dispatch("cart-refresh");

        notyf('Product added to cart successfully!');
    }

    public function addToWishlist()
    {
        if (!auth('customer')->check()) {
            return $this->redirect(route('auth.login'));
        }

        auth('customer')->user()->wishlist()->updateOrCreate(
            ['product_id' => $this->product->id]
        );

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
