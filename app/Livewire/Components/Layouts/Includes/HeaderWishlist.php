<?php

namespace App\Livewire\Components\Layouts\Includes;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Wishlist;

class HeaderWishlist extends Component
{
    #[On('wishlist-refresh')]
    public function refreshWishlistCount()
    {
        $this->dispatch('wishlist-updated', ['wishlistCount' => $this->wishlistCount]);
    }

    public function getWishlistCountProperty($wishlist = new Wishlist())
    {
        return $wishlist->wishlistItems()->count();
    }

    public function render()
    {
        return view('livewire.components.layouts.includes.header-wishlist');
    }
}
