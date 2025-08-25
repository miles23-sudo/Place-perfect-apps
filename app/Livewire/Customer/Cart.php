<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Computed;

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
        return auth('customer')->user()?->cart->get() ?? [];
    }

    #[Computed]
    public function totalPrice()
    {
        return auth('customer')->user()?->cart->get()->sum('total') ?? 0;
    }

    public function checkout()
    {
        if ($this->cartItems()->isEmpty()) {
            notyf('Your cart is empty!', 'warning');
            return;
        }

        if (!auth('customer')->check()) {
            return;
        }

        if (auth('customer')->user()->customerAddress === null) {
            return;
        }

        // $this->redirect(route('checkout'));
    }

    public function render()
    {
        return view('livewire.customer.cart');
    }
}
