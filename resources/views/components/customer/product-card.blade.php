<div>
    @php
        $record = $getRecord();
    @endphp

    <div class="max-w-3xl mx-auto p-6 md:p-8 bg-white dark:bg-gray-900 shadow-lg rounded-2xl mt-10">
        <div class="border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-title dark:text-white">Order Confirmation</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Thank you for your purchase!</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm text-gray-700 dark:text-gray-300">
            <div>
                <p class="font-medium text-title dark:text-white">Order Number</p>
                <p>#{{ $record->order_number }}</p>
            </div>

            <div>
                <p class="font-medium text-title dark:text-white">Checkout Session ID</p>
                <p>{{ $record->checkout_session_id }}</p>
            </div>

            <div>
                <p class="font-medium text-title dark:text-white">Customer ID</p>
                <p>{{ $record->customer_id }}</p>
            </div>

            <div>
                <p class="font-medium text-title dark:text-white">Status</p>
                <span
                    class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-white text-xs font-semibold">
                    {{ $record->status->getLabel() }}
                </span>
            </div>

            <div class="sm:col-span-2">
                <p class="font-medium text-title dark:text-white">Shipping Address</p>
                <p>{{ $record->shipping_address }}</p>
            </div>

            <div>
                <p class="font-medium text-title dark:text-white">Total Amount</p>
                <p class="text-lg font-bold text-green-600 dark:text-green-400">
                    {{ $record->overall_total_with_currency_symbol }}
                </p>
            </div>

            <div>
                <p class="font-medium text-title dark:text-white">Paid At</p>
                {{-- <p>{{ $record->paid_at->format('F j, Y • h:i A') }}</p> --}}
            </div>

            <div>
                <p class="font-medium text-title dark:text-white">Placed At</p>
                {{-- <p>{{ $record->created_at->format('F j, Y • h:i A') }}</p> --}}
            </div>
        </div>
    </div>

</div>
