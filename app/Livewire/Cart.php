<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Cart as CartModel;

class Cart extends Component
{
    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity < 1 || $quantity > 100) {
            notyf('Quantity must be between 1 and 100!', 'warning');
            return;
        }

        $this->cartItems()->findOrFail($itemId)->update(['quantity' => $quantity]);
    }

    public function removeItem($itemId)
    {
        $cartItem = $this->cartItems()->findOrFail($itemId);
        $cartItem->delete();

        notyf('Item removed from cart successfully!');
    }

    #[Computed]
    public function cartItems()
    {
        // check if authenticated customer has a cart
        if (auth()->check()) {
            CartModel::where('customer_id', auth()->id())->get();
        }

        return CartModel::where('session_id', session()->getId())->get();
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
