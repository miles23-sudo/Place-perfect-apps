<?php

namespace App\Services;

use Luigel\Paymongo\Facades\Paymongo;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\OrderPaymentMethod;

class PaymongoCheckout
{
    public static function create(Order $order, array $items)
    {
        if (!$order || blank($items)) throw new \InvalidArgumentException('Order and items are required.');

        if (array_filter($items, function ($item) {
            return !isset($item['name'], $item['currency'], $item['amount'], $item['quantity']);
        })) {
            throw new \InvalidArgumentException('Each item must have name, currency, amount, and quantity.');
        }

        return Paymongo::checkout()->create([
            'reference_number' => $order->order_number,
            'metadata' => [
                'order_number' => $order->order_number,
                'user_id' => auth('customer')->id(),
            ],
            'statement_descriptor' => config('app.name') . ' Checkout',
            'description' => config('app.name') . ' Checkout Session',
            'billing' => auth('customer')->user()->only(['name', 'email', 'phone']),
            'line_items' => $items,
            'payment_method_types' => OrderPaymentMethod::getOnlineMethods(),
            'success_url' => route('payment.status', ['order_number' => $order->order_number]),
            'cancel_url' => route('cart'),
        ]);
    }
}
