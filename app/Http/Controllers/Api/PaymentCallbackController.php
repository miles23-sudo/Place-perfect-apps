<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Enums\OrderStatus;

class PaymentCallbackController extends Controller
{
    public function handleOnline(Request $request, $order_number)
    {
        $order = Order::whereOrderNumber($order_number)
            ->whereStatus(OrderStatus::ToShip->value);

        if ($order->exists()) {
            $order->first()->customer->cart->each(fn($item) => $item->delete());

            return view('api.payment-success', compact('order_number'));
        }

        abort(404, 'Order not found or already processed.');
    }

    public function handleCOD(Request $request, $order_number)
    {
        $order = Order::whereOrderNumber($order_number)
            ->whereStatus(OrderStatus::ToPay->value);

        if ($order->exists()) {
            $order->first()->customer->cart->each(fn($item) => $item->delete());

            return view('api.cod-success', compact('order_number'));
        }

        abort(404, 'Order not found or already processed.');
    }
}
