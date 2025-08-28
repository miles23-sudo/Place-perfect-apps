@props(['customer'])

<div class="space-y-1 text-sm text-gray-700 dark:text-gray-200">
    <div>
        <strong>Name:</strong> {{ $customer->name }}
    </div>
    <div>
        <strong>Phone Number:</strong> {{ $customer->phone_number }}
    </div>
    <div>
        <strong>Email:</strong> {{ $customer->email }}
    </div>
    <div>
        <strong>Address:</strong> {{ $customer->customerAddress->address }}
    </div>
</div>
