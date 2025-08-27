<x-mail::message>
### Order #{{ $order->id }}

Hello **{{ $order->customer->name }}**,

Great news! Your order is now packed and ready to be shipped.
Once it’s handed over to our courier, we’ll send you another update along with tracking details.

Thank you for shopping with us — we can’t wait for you to receive your items! 💙

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
