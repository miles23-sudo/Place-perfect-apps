<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ARModule extends Component
{
    public $product;

    #[Computed]
    public function productArImage()
    {
        return $this->product->ar_image;
    }

    public function render()
    {
        return view('livewire.a-r-module');
    }
}
