<?php

namespace App\Livewire\Components\Layouts\Includes;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Cart;

class HeaderCart extends Component
{

    #[On('cart-refresh')]
    public function refreshCartCount()
    {
        $this->dispatch('cart-updated', ['cartCount' => $this->cartCount]);
    }

    public function getCartCountProperty($cart = new Cart())
    {
        return $cart->cartItems()->count();
    }

    public function render()
    {
        return view('livewire.components.layouts.includes.header-cart');
    }
}
