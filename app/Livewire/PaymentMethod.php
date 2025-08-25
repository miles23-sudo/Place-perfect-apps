<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Settings\Payment;

class PaymentMethod extends Component
{
    #[Computed]
    public function getPaymentSettings()
    {
        return app(Payment::class);
    }

    public function render()
    {
        return view('livewire.payment-method');
    }
}
