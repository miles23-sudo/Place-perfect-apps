<?php

namespace App\Livewire\Customer;

use App\Rules\AcrossValenzuelaOnly;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Validation\Rules\Password;

class Account extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|starts_with:09|size:11')]
    public $phone_number;

    public $address, $latitude, $longitude;

    public $old_password, $new_password;

    public function mount()
    {
        $profile = auth('customer')->user()->only(['name', 'email', 'phone_number']);
        $address = auth('customer')->user()->customerAddress ? auth('customer')->user()->customerAddress->only(['address', 'latitude', 'longitude']) : [];

        $this->fill(array_merge($profile, $address));
    }

    public function submitProfile()
    {
        $this->validate();

        auth('customer')->user()->update($this->only(['name', 'email', 'phone_number']));

        notyf('Profile updated successfully!');
    }

    public function submitAddress()
    {
        $this->validate([
            'address' => ['required', 'string', 'max:255', new AcrossValenzuelaOnly()],
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        auth('customer')->user()->customerAddress()->updateOrCreate(
            ['customer_id' => auth('customer')->id()],
            $this->only(['address', 'latitude', 'longitude'])
        );

        notyf('Address updated successfully!');
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
