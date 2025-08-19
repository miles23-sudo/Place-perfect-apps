<?php

namespace App\Livewire;

use NumberFormatter;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Flasher\Prime\Notification\Type;
use App\Models\Product;
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

        notyf('Product removed from cart successfully!', type: Type::WARNING);
    }

    #[Computed]
    public function cartItems()
    {
        // check if authenticated customer has a cart
        if (auth('customer')->check()) {
            return CartModel::whereCustomerId(auth('customer')->id())->get();
        }

        return CartModel::whereSessionId(session()->getId())->get();
    }

    #[Computed]
    public function totalPrice()
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->cartItems()->sum('total'), Product::CURRENCY);
    }

    public function checkout()
    {
        if ($this->cartItems()->isEmpty()) {
            notyf('Your cart is empty!', 'warning');
            return;
        }

        if (!auth('customer')->check()) {
            $this->redirect(route('filament.customer.auth.login'));
            return;
        }

        $this->redirect(route('checkout'));
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
