<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;

class Checkout extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|starts_with:+639|size:13')]
    public $phone_number;

    #[Validate('required|string|max:50')]
    public $house_number;

    #[Validate('required|string|max:50')]
    public $street;

    #[Validate('required|string|max:100')]
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
        if (blank($this->cartItems())) {
            notyf('Your cart is empty!', 'warning');
            return redirect()->route('cart');
        }

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

    public function placeOrder()
    {
        $this->validate();
    }

    #[Computed]
    public function cartItems($cart = new Cart())
    {
        return $cart->cartItems();
    }

    #[Computed]
    public function totalPrice($cart = new Cart())
    {
        return $cart->totalPrice();
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
