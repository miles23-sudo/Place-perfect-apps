<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Wishlist as WishlistModel;
use App\Models\Product;
use App\Models\Cart;
use Flasher\Prime\Notification\Type;

class Wishlist extends Component
{
    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        Cart::addOrUpdate($product->id, 1);

        $this->wishlistItems()->where('product_id', $product->id)->firstOrFail()->delete();

        $this->dispatch("cart-refresh");

        $this->dispatch("wishlist-refresh");

        notyf('Product added to cart successfully!');
    }

    public function removeFromWishlist($product_id)
    {
        $this->wishlistItems()->where('product_id', $product_id)->firstOrFail()->delete();

        $this->dispatch("wishlist-refresh");

        notyf('Product removed from wishlist successfully!', type: Type::WARNING);
    }

    #[Computed]
    public function wishlistItems()
    {
        return WishlistModel::whereCustomerId(auth('customer')->id())->get();
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
