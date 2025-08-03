<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Rules\RegionAddressExist;

class Checkout extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|start_with:+639|length:13')]
    public $phone_number;

    #[Validate('required|string|max:100')]
    public $house_number;

    #[Validate('required|string|max:100')]
    public $street;

    #[Validate(['required', 'string', 'max:100', new RegionAddressExist()])]
    public $region;

    #[Validate('required|string|max:100')]
    public $province;

    #[Validate('required|string|max:100')]
    public $city;

    #[Validate('required|string|max:100')]
    public $barangay;

    #[Validate('required|string|max:100')]
    public $additional_notes;

    #[Validate('required|in:cod,online_payment')]
    public $payment_method;

    public function mount()
    {
        $this->fill(auth('customer')->user()->only([
            'name',
            'email',
            'phone_number',
            'house_number',
            'street',
            'region',
            'province',
            'city',
            'barangay',
        ]));
    }
    public function render()
    {
        return view('livewire.checkout');
    }
}
