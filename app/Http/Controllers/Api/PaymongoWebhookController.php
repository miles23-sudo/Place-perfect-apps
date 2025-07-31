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

        \Log::info('✅ Webhook received', $request->all());

        $payload = $request->input('data.attributes.data.attributes');

        $order_number = $payload['metadata']['order_number'] ?? null;
        $user_id = $payload['metadata']['user_id'] ?? null;
        $payment_method = $payload['source']['type'] ?? null;
        $status = $payload['status'] ?? null;

        if ($status === 'paid' && $order_number) {
            $order = Order::where('order_number', $order_number)->first();

            if ($order && $order->status == OrderStatus::ToPay) {
                $order->update([
                    'status' => OrderStatus::ToShip->value,
                    'payment_method' => $payment_method,
                    'paid_at' => now(),
                ]);

                // Remove all items from the cart
                if ($user_id) {
                    $customer = Customer::find($user_id);
                    if ($customer) {
                        $customer->cart()->delete();
                    }
                }

                return response()->json(['message' => 'Webhook processed']);
            }
        }

        return response()->json(['message' => 'Webhook not processed']);
    }

    // Create Webhook 
    public function createWebhook()
    {
        $webhook = Paymongo::webhook()->create([
            'url' => env('NGROK_URL') . '/api/webhook/paymongo',
            'events' => [
                'payment.paid',
                'payment.failed',
            ]
        ]);

        if ($webhook) {
            \Log::info('Webhook created successfully.', ['id' => $webhook->id]);
            return response()->json(['message' => 'Webhook created successfully.', 'webhook_id' => $webhook->id]);
        }

        return response()->json(['error' => 'Failed to create webhook.'], 200);
    }

    // Enable Webhook
    public function enableWebhook($webhookId)
    {
        $webhook = Paymongo::webhook()->enable($webhookId);

        if ($webhook) {
            \Log::info("Webhook {$webhookId} enabled successfully.");
            return response()->json(['message' => 'Webhook enabled successfully.']);
        }

        return response()->json(['error' => 'Failed to enable webhook.'], 500);
    }
}
