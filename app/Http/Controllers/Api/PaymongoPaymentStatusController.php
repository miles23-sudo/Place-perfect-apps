<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;

class PaymongoPaymentStatusController extends Controller
{
    public function handle(Request $request, $order_number)
    {
        $order = Order::where('order_number', $order_number)
            ->where('status', OrderStatus::ToShip->value)
            ->exists();

        if ($order) {
            return view('api.payment-success', compact('order_number'));
        }

        return view('api.payment-failed', compact('order_number'));
    }
}
