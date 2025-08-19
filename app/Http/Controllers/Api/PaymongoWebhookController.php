<?php

namespace App\Http\Controllers\Api;

use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Enums\OrderStatus;

class PaymongoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->input('data.attributes.data.attributes');

        \Log::info('Paymongo Webhook Payload:', $payload);

        $user_id = $payload['metadata']['user_id'] ?? null;
        $order_number = $payload['metadata']['order_number'] ?? null;

        $payment_method = $payload['source']['type'] ?? null;
        $status = $payload['status'] ?? null;
        $customer_email = $payload['billing']['email'] ?? null;

        if ($status == 'paid' && $order_number) {

            $order = Order::whereOrderNumber($order_number)->first();

            if ($order && in_array($order->status, [OrderStatus::ToPay, OrderStatus::ToRetryPayment])) {
                $order->update([
                    'status' => OrderStatus::ToShip->value,
                    'payment_method' => $payment_method,
                    'paid_at' => now(),
                ]);

                return response()->json(['message' => 'Webhook processed']);
            }
        }

        if ($status == 'failed') {

            // get the customer email $customer_email order that is in the ToPay status
            $order = Order::whereHas('customer', function ($query) use ($customer_email) {
                $query->where('email', $customer_email);
            })
                ->where('status', OrderStatus::ToPay->value)->first();

            if ($order) {
                $order->update([
                    'status' => OrderStatus::ToRetryPayment->value,
                    'payment_method' => $payment_method,
                ]);

                return response()->json(['message' => 'Payment failed']);
            }
        }

        return response()->json(['message' => 'Webhook not processed']);
    }
}
