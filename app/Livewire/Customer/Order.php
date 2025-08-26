<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Computed;

class Order extends Component
{
    #[Computed]
    public function getOrders()
    {
        return auth('customer')->user()->orders;
    }

    public function render()
    {
        return view('livewire.customer.order');
    }
}
