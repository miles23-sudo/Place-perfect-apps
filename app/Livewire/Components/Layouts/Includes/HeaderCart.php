<?php

namespace App\Livewire\Components\Layouts\Includes;

use Livewire\Component;
use Livewire\Attributes\On;

class HeaderCart extends Component
{
    public $cartCount = 0;

    public function render()
    {
        return view('livewire.components.layouts.includes.header-cart');
    }
}
