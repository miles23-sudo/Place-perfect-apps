<?php

namespace App\Livewire\Customer;

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

        $this->dispatch("cart-refresh");

        notyf('Product removed from cart successfully!');
    }

    #[Computed]
    public function cartItems()
    {
        return CartModel::whereCustomerId(auth('customer')->id())->get();
    }

    #[Computed]
    public function totalPrice()
    {
        return $this->cartItems()->sum('total') ?? 0;
    }

    public function checkout()
    {
        if ($this->cartItems()->isEmpty()) {
            notyf('Your cart is empty!', 'warning');
            return;
        }

        if (!auth('customer')->user()->customerAddress) {
            notyf('Please add a shipping address before proceeding to checkout.', 'warning');
            return $this->redirect(route('customer.account'));
        }

        $this->redirect(route('customer.checkout'));
    }

    public function render()
    {
        return view('livewire.customer.cart');
    }
}
