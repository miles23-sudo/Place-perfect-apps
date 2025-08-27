<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Mail;
use App\Models\Order as OrderModel;
use App\Mail\Order\DeliveredMail;
use App\Enums\OrderStatus;

class Order extends Component
{

    public function markAsReceived($order_id)
    {
        $order = auth('customer')->user()->orders()
            ->findOrFail($order_id);

        $order->update([
            'status' => OrderStatus::Delivered->value,
            'delivered_at' => now()
        ]);

        Mail::to(auth('customer')->user()->email)->send(new DeliveredMail($order));

        notyf('Thank you for confirming the receipt of your order.');
    }

    public function cancelOrder($order_id)
    {
        auth('customer')->user()->orders()
            ->findOrFail($order_id)
            ->whereStatus(OrderStatus::ToPay->value)
            ->update([
                'status' => OrderStatus::Cancelled->value,
                'cancelled_at' => now()
            ]);

        notyf('Your order has been cancelled.');
    }

    #[Computed]
    public function getOrders()
    {
        return auth('customer')->user()->orders;
    }

    public function render()
    {
        return view('livewire.customer.order');
    }
}
