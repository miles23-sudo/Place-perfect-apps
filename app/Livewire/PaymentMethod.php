<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Settings\Payment;

class PaymentMethod extends Component
{
    #[Computed]
    public function getPaymentMethodLabels()
    {
        return app(Payment::class)->getPaymentMethodLabels();
    }

    #[Computed]
    public function getPaymentTerms()
    {
        return app(Payment::class)->payment_terms;
    }

    public function render()
    {
        return view('livewire.payment-method');
    }
}
