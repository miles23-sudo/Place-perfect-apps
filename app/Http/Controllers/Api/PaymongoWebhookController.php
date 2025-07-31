<?php

namespace App\Http\Controllers\Api;

use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Enums\OrderStatus;

class PaymongoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->input('data.attributes.data.attributes');

        $orderId = $payload['metadata']['order_number'] ?? null;
        $userId = $payload['metadata']['user_id'] ?? null;
        $status = $payload['status'] ?? null;

        if ($status === 'paid' && $orderId) {
            $order = Order::where('order_number', $orderId)->first();

            if ($order && $order->status == OrderStatus::AwaitingPayment) {
                $order->update([
                    'status' => OrderStatus::Paid,
                    'paid_at' => now(),
                ]);

                // Remove all items from the cart
                auth('customer')->user()->cartItems()->each(function ($item) {
                    $item->delete();
                });

                \Log::info("✅ Order {$order->order_number} marked as PAID!");
            }
        }

        return response()->json(['message' => 'Webhook processed']);
    }

    // Create Webhook 
    public function createWebhook()
    {
        $webhook = Paymongo::webhook()->create([
            'url' => 'https://5a378945c459.ngrok-free.app/api/webhook/paymongo',
            'events' => [
                'payment.paid',
                'payment.failed',
            ]
        ]);

        if ($webhook) {
            \Log::info('Webhook created successfully.', ['id' => $webhook->id]);
            return response()->json(['message' => 'Webhook created successfully.', 'webhook_id' => $webhook->id]);
        }

        return response()->json(['error' => 'Failed to create webhook.'], 500);
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
