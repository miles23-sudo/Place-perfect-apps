<?php

namespace App\Livewire\Customer;

use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Mail;
use App\Settings\Payment;
use App\Rules\AcrossValenzuelaOnly;
use App\Models\Order;
use App\Mail\Order\ToPayMail;
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
            'additional_notes' => 'nullable|string|max:255',
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

        $order = auth('customer')->user()->orders()->create([
            'subtotal' => $this->cartItems->sum('total'),
            'shipping_fee' => $this->shippingFee,
            'payment_mode' => $this->payment_mode,
            'additional_notes' => $this->additional_notes,
            'pay_at' => now()
        ]);

        $order->items()->createMany(
            $this->cartItems()->map(fn($item) =>  $item->only(['product_id', 'price', 'quantity']))->toArray()
        );

        if ($this->payment_mode == OrderPaymentMode::Online->value) {
            $this->payment_proof = $this->payment_proof ? $this->payment_proof->store(path: 'payment_proofs') : null;

            $order->update([
                'payment_channel' => $this->payment_channel,
                'payment_proof' => $this->payment_proof,
            ]);
        }

        Mail::to(auth('customer')->user()->email)->later(now()->addSeconds(5), new ToPayMail($order));

        auth('customer')->user()->cart()->delete();

        $this->redirect(route('customer.order-placed', [$order->id]));
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
