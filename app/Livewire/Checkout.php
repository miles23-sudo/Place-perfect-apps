<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Settings\Payment;
use App\Services\PaymongoCheckout;
use App\Models\Product;
use App\Enums\PaymentMode;

class Checkout extends Component
{
    public $name, $email, $phone_number;

    public $address;

    public $additional_notes;

    public $payment_method;

    public function mount()
    {
        if (blank($this->cartItems())) {
            notyf('Your cart is empty!', 'warning');
            return redirect()->route('cart');
        }

        //  customer address to the customer model
        $customer = auth('customer')->user()->load('customerAddress');
        $customer_data = collect($customer->only(['name', 'email', 'phone_number']))
            ->merge($customer->customerAddress?->only([
                'address',
            ]) ?? [])
            ->toArray();

        $this->fill($customer_data);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|starts_with:+639|size:13',
            'address' => 'required|string|max:255',
            'additional_notes' => 'nullable|string|max:100',
            'payment_method' => ['required', 'in:' . implode(',', array_keys(app(Payment::class)->getPaymentMethodChoices()))],
        ];
    }

    public function placeOrder()
    {
        $this->validate();

        $order = auth('customer')->user()->orders()->create([
            'shipping_address' => auth('customer')->user()->customerAddress->address,
            'overall_total' => $this->cartItems()->sum('total'),
            'additional_notes' => $this->additional_notes,
        ]);

        $order->items()->createMany($this->cartItems()->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ];
        })->toArray());

        if ($this->payment_method == PaymentMode::OnlinePayment->value) {
            $checkout = PaymongoCheckout::create($order, $this->cartItems()->map(function ($item) {
                return [
                    'name' => $item->product->name,
                    'currency' => Product::CURRENCY,
                    'amount' => intval($item->price * 100),
                    'quantity' => $item->quantity,
                ];
            })->toArray());

            $order->update(['checkout_session_id' => $checkout->id]);

            return $this->redirectIntended($checkout->checkout_url);
        }

        $order->update(['payment_method' => PaymentMode::COD->value]);

        return $this->redirectIntended(route('handle-payment.cod', ['order_number' => $order->order_number]));
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
