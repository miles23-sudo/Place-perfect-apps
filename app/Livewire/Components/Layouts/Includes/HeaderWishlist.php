<?php

namespace App\Livewire\Components\Layouts\Includes;

use Livewire\Component;
use Livewire\Attributes\On;

class HeaderWishlist extends Component
{
    public $wishlistCount = 0;

    public function render()
    {
        return view('livewire.components.layouts.includes.header-wishlist');
    }
}
