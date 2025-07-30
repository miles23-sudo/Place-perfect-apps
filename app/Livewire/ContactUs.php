<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Settings\Contact;

class ContactUs extends Component
{
    #[Computed]
    public function settings()
    {
        return app(Contact::class);
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}
