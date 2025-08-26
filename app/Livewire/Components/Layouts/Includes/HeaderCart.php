<?php

namespace App\Livewire\Components\Layouts\Includes;

use Livewire\Component;
use Livewire\Attributes\On;

class HeaderCart extends Component
{
    #[On('cart-refresh')]
    public function refreshCartCount()
    {
        $this->dispatch('cart-updated', ['cartCount' => $this->cartCount]);
    }

    public function getCartCountProperty()
    {
        if (auth('customer')->check()) {
            return auth('customer')->user()->cart()->count();
        }

        return 0;
    }

    public function render()
    {
        return view('livewire.components.layouts.includes.header-cart');
    }
}
