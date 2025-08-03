<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Settings\Payment;

class Checkout extends Component
{
    public $name, $email, $phone_number;

    public $house_number, $street, $region, $province, $city, $barangay;

    public $additional_notes;

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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|starts_with:+639|size:13',
            'house_number' => 'required|string|max:50',
            'street' => 'required|string|max:50',
            'region' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'barangay' => 'required|string|max:100',
            'additional_notes' => 'nullable|string|max:100',
            'payment_method' => ['required', 'in:' . implode(',', array_keys(app(Payment::class)->getPaymentMethodChoices()))],
        ];
    }

    public function placeOrder()
    {
        $this->validate();

        auth('customer')->user()->update($this->only([
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

        $order
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

    #[Computed]
    public function paymentMethodChoices()
    {
        return app(Payment::class)->getPaymentMethodChoices();
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
