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
            ->whereStatus(OrderStatus::ToShip->value)
            ->exists();

        if ($order) {
            return view('api.payment-success', compact('order_number'));
        }

        return view('api.payment-failed', compact('order_number'));
    }

    public function handleCOD(Request $request, $order_number)
    {
        $order = Order::whereOrderNumber($order_number)
            ->whereStatus(OrderStatus::ToPay->value)
            ->exists();

        if ($order) {
            return view('api.cod-success', compact('order_number'));
        }

        return view('api.cod-failed', compact('order_number'));
    }
}
