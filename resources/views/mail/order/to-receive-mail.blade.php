<x-mail::message>
# Your Order #{{ $order->id }} is On the Way! 📦

Hello **{{ $order->customer->name }}**,

Great news — your order has been handed over to our delivery partner and is now **{{ $order->status->getDescription() }}**.
Please keep your phone nearby as the driver may contact you upon arrival.

<x-mail::button :url="route('customer.order')">
Track My Order
</x-mail::button>

Make sure someone is available at your delivery address to receive the package.
We hope you’re as excited as we are for your items to arrive! 🎉

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
