<?php

namespace App\Livewire\Auth;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Register extends Component
{
    #[Validate('required|string')]
    public $name;

    #[Validate('required|string|starts_with:09|size:11')]
    public $phone_number;

    #[Validate('required|email|unique:customers,email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    #[Validate('boolean')]
    public $remember_me = false;

    public function register()
    {
        $this->validate();

        $customer = Customer::create($this->only(['name', 'phone_number', 'email', 'password']));

        auth('customer')->login($customer, $this->remember_me);

        $this->redirectIntended(route('customer.account'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
