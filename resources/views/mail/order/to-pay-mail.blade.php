<x-mail::message>
### Order #{{ $order->id }}

Hello **{{ $order->customer->name }}**,

Thank you for your order! 🎉<br>
We’ve received your checkout details and your payment status is currently being verified.<br><br>
Here’s a quick summary of your order:

<x-mail::table>
| Item | Price | Qty | Total |
| ---- | :---: | --: | ----: |
@foreach ($order->items as $item)
| {{ $item->product->name }} | ₱{{ number_format($item->price, 2) }} | {{ $item->quantity }} | ₱{{ number_format($item->total_price, 2) }} |
@endforeach
</x-mail::table>

<x-mail::button :url="route('customer.order')">
View More
</x-mail::button>

If you have any questions or concerns, feel free to reach out to us<br>
[Contact Us]({{ route('contact-us') }}) — we’re always happy to help!

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
