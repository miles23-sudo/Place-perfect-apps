<x-mail::message>
Hello **{{ $order->customer->name }}**,

We’ve received your **return/refund request** and it is now **under review** by our team.  
Please allow us some time to verify the details and process your request.  

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>