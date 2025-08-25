<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Settings\Shipping;

class ShippingMethod extends Component
{
    #[Computed]
    public function getShippingSettings()
    {
        return app(Shipping::class);
    }

    public function render()
    {
        return view('livewire.shipping-method');
    }
}
