<?php

namespace App\Livewire\Customer;

use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Settings\Payment;
use App\Rules\AcrossValenzuelaOnly;
use App\Enums\OrderPaymentMode;

class Checkout extends Component
{
    use WithFileUploads;

    public $name, $email, $phone_number;

    public $address, $latitude, $longitude;

    public $additional_notes;

    public $payment_mode, $payment_channel, $payment_proof;

    public function mount()
    {
        if (auth('customer')->user()->cart()->count() < 1) {
            return $this->redirect(route('customer.cart'));
        }

        $profile = auth('customer')->user()->only(['name', 'email', 'phone_number']);
        $address = auth('customer')->user()->customerAddress ? auth('customer')->user()->customerAddress->only(['address', 'latitude', 'longitude']) : [];

        $this->fill(array_merge($profile, $address));
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|starts_with:09|size:11',
            'address' => ['required', 'string', 'max:255', new AcrossValenzuelaOnly()],
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'additional_notes' => 'required|string|max:255',
            'payment_mode' => ['required', 'in:' . implode(',', array_column(OrderPaymentMode::cases(), 'value'))],
            'payment_channel' => ['requiredIf:payment_mode,online', 'nullable', 'in:' . implode(',', array_column(app(Payment::class)->online_channels, 'name'))],
            'payment_proof' => ['requiredIf:payment_mode,online', 'nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:20000'],
        ];
    }

    public function processCheckout()
    {
        $this->validate();

        auth('customer')->user()->update($this->only(['name', 'email', 'phone_number']));

        auth('customer')->user()->customerAddress()->update($this->only(['address', 'latitude', 'longitude']));

        dd($this->pull());
    }

    #[Computed]
    public function cartItems()
    {
        return auth('customer')->user()->cart()->get();
    }

    #[Computed]
    public function shippingFee()
    {
        return auth('customer')->user()->customerAddress->shipping_fee;
    }

    #[Computed]
    public function overallTotal()
    {
        return $this->cartItems->sum('total') + $this->shippingFee;
    }

    public function render()
    {
        $payment_modes = OrderPaymentMode::cases();
        $payment_channels = app(Payment::class)->online_channels;

        return view('livewire.customer.checkout', compact('payment_modes', 'payment_channels'));
    }
}
