<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Settings\Shipping;

class ShippingMethod extends Component
{
    #[Computed]
    public function getDistanceFeeFormatted()
    {
        return app(Shipping::class)->getDistanceFeeFormatted();
    }

    #[Computed]
    public function getDeliveryTerms()
    {
        return app(Shipping::class)->delivery_terms;
    }

    public function render()
    {
        return view('livewire.shipping-method');
    }
}
