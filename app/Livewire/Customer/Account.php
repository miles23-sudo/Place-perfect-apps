<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules\Password;

class Account extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|starts_with:09|size:11')]
    public $phone_number;

    public $address;

    public $old_password, $new_password;

    public function mount()
    {
        $this->fill(auth('customer')->user()->only(['name', 'email', 'phone_number']));
    }

    public function updateProfile()
    {
        $this->validate();

        auth('customer')->user()->update($this->only(['name', 'email', 'phone_number']));

        notyf('Profile updated successfully!');
    }

    public function resetPassword()
    {
        $this->validate([
            'old_password' => 'required|current_password:customer',
            'new_password' => ['required', Password::min(8)->uncompromised()],
        ]);

        auth('customer')->user()->update(['password' => bcrypt($this->new_password)]);

        $this->reset();

        notyf('Password updated successfully!');
    }

    public function render()
    {
        return view('livewire.customer.account');
    }
}
