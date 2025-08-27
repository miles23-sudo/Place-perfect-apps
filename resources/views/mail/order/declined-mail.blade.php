<x-mail::message>
### Order #{{ $order->id }}

Hello **{{ $order->customer->name }}**,

We’re sorry to inform you that your recent order could not be processed and has been **{{ $order->status->getDescription() }}**.
This may happen due to payment issues, stock availability, or other verification concerns.<br><br>

<x-mail::panel>
**Order Status:** {{ $order->status->getLabel() }}<br>
**Total Amount:** ₱{{ $order->overall_total }}
</x-mail::panel>

But don’t worry — you can try placing your order again once the issue is resolved.

<x-mail::button :url="route('shop')">
Shop Again
</x-mail::button>

If you believe this was a mistake or have any questions, go to [Contact Us]({{ route('contact-us') }}) — we’ll be glad to assist you.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
