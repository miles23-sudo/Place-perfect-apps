<?php

namespace App\Livewire;

use NumberFormatter;
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

        $this->dispatch("cart-refresh");

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

        $this->redirect(route('checkout'));

        // $order_number = uniqid(strtoupper(substr(config('app.name'), 0, 2)));

        // $order = auth('customer')->user()->orders()->create([
        //     'order_number' => $order_number,
        //     'shipping_address' => auth('customer')->user()->customerAddress->full_address,
        //     'overall_total' => $this->cartItems()->sum('total'),
        // ]);

        // $order->items()->createMany($this->cartItems()->map(function ($item) {
        //     return [
        //         'product_id' => $item->product_id,
        //         'quantity' => $item->quantity,
        //         'price' => $item->price,
        //     ];
        // })->toArray());

        // $checkout = PaymongoCheckout::create($order, $this->cartItems()->map(function ($item) {
        //     return [
        //         'name' => $item->product->name,
        //         'currency' => Product::CURRENCY,
        //         'amount' => intval($item->price * 100),
        //         'quantity' => $item->quantity,
        //     ];
        // })->toArray());

        // $order->update(['checkout_session_id' => $checkout->id]);

        // return redirect()->away($checkout->checkout_url);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
