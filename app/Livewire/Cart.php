<?php

namespace App\Livewire;

use NumberFormatter;
use Luigel\Paymongo\Facades\Paymongo;
use Livewire\Component;
use Livewire\Attributes\Computed;
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
            $this->redirect(route('filament.customer.auth.login'));
            return;
        }

        $checkout = Paymongo::checkout()->create([
            'statement_descriptor' => 'Laravel Paymongo Library',
            'metadata' => [
                'Key' => 'Value'
            ],
            'billing' => auth('customer')->user()->only(['name', 'email', 'phone']),
            'description' => config('app.name') . ' Checkout Session',
            'line_items' => [
                [
                    'name' => 'A payment card',
                    'description' => 'Something of a product.',
                    'quantity' => 1,
                    'currency' => 'PHP',
                    'amount' => 10000,
                ]
            ],
            'payment_method_types' => Product::PAYMENT_METHODS,
            'success_url' => 'https://paymongo.rigelkentcarbonel.com/',
            'cancel_url' => route('cart'),
        ]);

        $this->redirectIntended($checkout->checkout_url);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
