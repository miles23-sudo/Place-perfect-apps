<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Order as OrderModel;
use App\Enums\OrderStatus;

class Order extends Component
{

    public function markAsReceived($order_id)
    {
        auth('customer')->user()->orders()->findOrFail($order_id)->update([
            'status' => OrderStatus::Delivered->value
        ]);

        notyf('Thank you for confirming the receipt of your order.');
    }

    public function cancelOrder($order_id)
    {
        auth('customer')->user()->orders()->findOrFail($order_id)->update([
            'status' => OrderStatus::Cancelled->value
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
