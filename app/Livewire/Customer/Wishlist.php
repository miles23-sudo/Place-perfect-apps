<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Wishlist as WishlistModel;
use App\Models\Product;
use App\Models\Cart;

class Wishlist extends Component
{
    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        auth('customer')->user()->cart()->updateOrCreate(
            ['product_id' => $product->id],
            [
                'quantity' => 1,
                'price' => $product->price
            ]
        );

        $this->wishlistItems()->where('product_id', $product->id)->firstOrFail()->delete();

        $this->dispatch("cart-refresh");

        $this->dispatch("wishlist-refresh");

        notyf('Product added to cart successfully!');
    }

    public function removeFromWishlist($product_id)
    {
        $this->wishlistItems()->where('product_id', $product_id)->firstOrFail()->delete();

        $this->dispatch("wishlist-refresh");

        notyf('Product removed from wishlist successfully!');
    }

    #[Computed]
    public function wishlistItems()
    {
        return WishlistModel::whereCustomerId(auth('customer')->id())->get();
    }

    public function render()
    {
        return view('livewire.customer.wishlist');
    }
}
