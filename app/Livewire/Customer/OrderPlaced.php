<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Order;

class OrderPlaced extends Component
{
    public $id;

    public function mount()
    {
        $this->getOrder();
    }

    #[Computed]
    public function getOrder()
    {
        return Order::findOrFail($this->id);
    }

    public function render()
    {
        return view('livewire.customer.order-placed');
    }
}
