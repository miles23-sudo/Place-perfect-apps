<?php

namespace App\Livewire\Components\Layouts\Includes;

use Livewire\Component;
use Livewire\Attributes\On;

class HeaderWishlist extends Component
{
    #[On('wishlist-refresh')]
    public function refreshWishlistCount()
    {
        $this->dispatch('wishlist-updated', ['wishlistCount' => $this->wishlistCount]);
    }

    public function getWishlistCountProperty()
    {
        if (auth('customer')->check()) {
            return auth('customer')->user()->wishlist()->count();
        }

        return 0;
    }

    public function render()
    {
        return view('livewire.components.layouts.includes.header-wishlist');
    }
}
