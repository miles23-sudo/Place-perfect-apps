<?php

namespace App\Livewire;

use NumberFormatter;
use Luigel\Paymongo\Facades\Paymongo;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Filament\Notifications\Notification;
use App\Models\Product;
use App\Models\Cart as CartModel;
use App\Filament\Customer\Clusters\Dashboard\Pages\MyOrder;

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

        $checkout = Paymongo::checkout()->create([
            'statement_descriptor' => config('app.name') . ' Checkout',
            'description' => config('app.name') . ' Checkout Session',
            'metadata' => [
                'Key' => 'Value'
            ],
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
            'success_url' => route(MyOrder::getUrl()),
            'cancel_url' => route('cart'),
        ]);
        dd($checkout);
        $this->redirectIntended($checkout->checkout_url);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
