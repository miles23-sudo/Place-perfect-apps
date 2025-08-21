<?php

namespace App\Livewire;

use NumberFormatter;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Settings\Shipping;
use App\Settings\Payment;
use App\Services\PaymongoCheckout;
use App\Services\Haversine;
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

        DB::transaction(function () {
            $order = auth('customer')->user()->orders()->create([
                'shipping_address' => auth('customer')->user()->customerAddress->address,
                'subtotal'         => $this->subTotal,
                'shipping_fee'     => $this->shippingFee,
                'additional_notes' => $this->additional_notes,
            ]);

            // save items
            $order->items()->createMany(
                $this->cartItems()->map(
                    fn($item) =>
                    $item->only(['product_id', 'quantity', 'price'])
                )->toArray()
            );

            if ($this->payment_method == PaymentMode::OnlinePayment->value) {
                $line_items = $this->cartItems()->map(function ($item) {
                    return [
                        'name'     => $item->product->name,
                        'currency' => Product::CURRENCY,
                        'amount'   => intval($item->price * 100),
                        'quantity' => $item->quantity,
                    ];
                })->toArray();

                if ($this->shippingFee > 0) {
                    $line_items[] = [
                        'name'     => 'Shipping Fee',
                        'currency' => Product::CURRENCY,
                        'amount'   => intval($this->shippingFee * 100),
                        'quantity' => 1,
                    ];
                }

                $checkout = PaymongoCheckout::create($order, $line_items);

                $order->update(['checkout_session_id' => $checkout->id]);

                return $this->redirectIntended($checkout->checkout_url);
            }

            // fallback COD
            $order->update(['payment_method' => PaymentMode::COD->value]);

            return $this->redirectIntended(
                route('handle-payment.cod', ['order_number' => $order->order_number])
            );
        });
    }


    #[Computed]
    public function cartItems($cart = new Cart())
    {
        return $cart->cartItems();
    }

    #[Computed]
    public function subTotal()
    {
        return $this->cartItems()->sum('total');
    }

    #[Computed]
    public function shippingFee()
    {
        return app(Shipping::class)->getShippingFee();
    }

    #[Computed]
    public function overallTotal()
    {
        return $this->subTotal + $this->shippingFee;
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
