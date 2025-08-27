<x-mail::message>
Hello **{{ $order->customer->name }}**,

We’re happy to let you know that your order has been **successfully delivered**.  
Thank you for trusting us — we hope you enjoy your purchase! 💙  

<x-mail::button :url="route('shop')">
Shop Again
</x-mail::button>

Your support means a lot to us. We look forward to serving you again soon! 🛍️  

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
