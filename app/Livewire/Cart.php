<?php

namespace App\Livewire;

use NumberFormatter;
use Luigel\Paymongo\Facades\Paymongo;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Filament\Notifications\Notification;
use App\Models\Product;
use App\Models\Cart as CartModel;

class Cart extends Component
{
    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity < 1 || $quantity > 100) {
            notyf('Quantity must be between 1 and 100!', 'warning');
            return;
        }

        $this->cartItems()->findOrFail($itemId)->update(['quantity' => $quantity]);
    }

    public function removeItem($itemId)
    {
        $cartItem = $this->cartItems()->findOrFail($itemId);
        $cartItem->delete();

        notyf('Item removed from cart successfully!');
    }

    #[Computed]
    public function cartItems()
    {
        // check if authenticated customer has a cart
        if (auth('customer')->check()) {
            return CartModel::where('customer_id', auth('customer')->id())->get();
        }

        return CartModel::where('session_id', session()->getId())->get();
    }

    #[Computed]
    public function totalPrice()
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->cartItems()->sum('total'), Product::CURRENCY);
    }

    public function checkout()
    {
        if ($this->cartItems()->isEmpty()) {
            notyf('Your cart is empty!', 'warning');
            return;
        }

        if (!auth('customer')->check()) {
            Notification::make()
                ->title('Authentication Required')
                ->body('Please log in to proceed with checkout.')
                ->danger()
                ->send();
            $this->redirect(route('filament.customer.auth.login'));
            return;
        }

        if (blank(auth('customer')->user()->customerAddress)) {
            Notification::make()
                ->title('Address Required')
                ->body('Please add your address before proceeding with checkout.')
                ->danger()
                ->send();
            $this->redirect(route('filament.customer.dashboard.pages.shipping-address'));
            return;
        }

        $order_number = uniqid(strtoupper(substr(config('app.name'), 0, 2)));

        $order = auth('customer')->user()->orders()->create([
            'order_number' => $order_number,
            'shipping_address' => auth('customer')->user()->customerAddress->full_address,
            'overall_total' => $this->cartItems()->sum('total'),
        ]);

        $order->items()->createMany($this->cartItems()->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ];
        })->toArray());

        $checkout = Paymongo::checkout()->create([
            'reference_number' => $order->order_number,
            'metadata' => [
                'order_number' => $order->order_number,
                'user_id' => auth('customer')->id(),
            ],
            'statement_descriptor' => config('app.name') . ' Checkout',
            'description' => config('app.name') . ' Checkout Session',
            'billing' => auth('customer')->user()->only(['name', 'email', 'phone']),
            'line_items' => $this->cartItems()->map(function ($item) {
                return [
                    'name' => $item->product->name,
                    'currency' => Product::CURRENCY,
                    'amount' => intval($item->price * 100),
                    'quantity' => $item->quantity,
                ];
            })->toArray(),
            'payment_method_types' => Product::PAYMENT_METHODS,
            'success_url' => route('payment.success', ['order_number' => $order->order_number]),
            'cancel_url' => route('cart'),
        ]);

        $order->update(['checkout_session_id' => $checkout->id]);

        return redirect()->away($checkout->checkout_url);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
