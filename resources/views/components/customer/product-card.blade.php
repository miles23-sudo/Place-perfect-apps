<div>
    @php
        $record = $getRecord();
    @endphp

    <div class="max-w-3xl p-6 mx-auto mt-10 bg-white shadow-lg md:p-8 dark:bg-gray-900 rounded-2xl">
        <div class="pb-4 mb-6 border-b">
            <h2 class="text-2xl font-bold text-title dark:text-white">Order Confirmation</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Thank you for your purchase!</p>
        </div>

        <div class="grid grid-cols-1 text-sm text-gray-700 sm:grid-cols-2 gap-y-4 gap-x-6 dark:text-gray-300">
            <div>
                <p class="font-medium text-title dark:text-white">Order Number</p>
                <p>#{{ $record->id }}</p>
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
                    class="inline-block px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-800 dark:text-white">
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
