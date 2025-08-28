<div>
    <x-shop.section :title="'Order History'">
        <div
            class="max-w-[1720px] mx-auto flex items-start gap-8 md:gap-12 2xl:gap-24 flex-col md:flex-row my-profile-navtab">

            @include('livewire.customer.include.sidebar')

            <div class="w-full overflow-hidden">
                <div class="bg-gray-50/50 dark:bg-gray-900/50">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        Product
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Items
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        Order #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Payment
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($this->getOrders as $order)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            @foreach ($order->items as $item)
                                                @if ($loop->first)
                                                    <div class="flex items-center gap-3">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                                alt="product"
                                                                class="object-cover w-full h-full rounded-md">
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p
                                                                class="text-xs tracking-wide text-gray-500 uppercase truncate dark:text-gray-400">
                                                                {{ $item->product->productCategory->name }}
                                                            </p>
                                                            <h5
                                                                class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                {{ $item->product->name }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </th>
                                        <td class="px-6 py-4 font-medium text-center text-gray-900 dark:text-white">
                                            {{ $order->items->count() }}
                                        </td>
                                        <td
                                            class="px-6 py-4 font-mono text-sm text-gray-600 bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
                                            {{ $order->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 inline-flex items-center gap-1">
                                                <x-icon :name="$order->payment_mode->getIcon()" class="w-4 h-4" />
                                                {{ $order->payment_mode->getLabel() }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 font-semibold text-right text-gray-900 bg-gray-50 dark:bg-gray-800 dark:text-white">
                                            ₱{{ $order->overall_total }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="bg-{{ $order->status->getColorPlain() }}-100 text-{{ $order->status->getColorPlain() }}-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-{{ $order->status->getColorPlain() }}-900 dark:text-{{ $order->status->getColorPlain() }}-300 inline-flex items-center gap-1">
                                                <x-icon :name="$order->status->getIcon()" class="w-3 h-3" />
                                                {{ $order->status->getLabel() }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                            <div class="flex justify-center">
                                                @if ($order->isToReceive())
                                                    <button type="button"
                                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg h-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                        wire:click="markAsReceived('{{ $order->id }}')"
                                                        wire:confirm="Are you sure you want to mark this order as received?">
                                                        Mark Received
                                                    </button>
                                                @elseif ($order->isDelivered())
                                                    <div class="flex gap-1.5">
                                                        <a href="{{ route('customer.review', ['order_id' => $order->id]) }}"
                                                            class="px-3 py-2 text-xs font-medium text-center text-white bg-orange-700 rounded-lg h-fit hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                                                            Review
                                                        </a>
                                                        @if ($order->isReturnRefundable())
                                                            <a href="{{ route('customer.return-refund-request', ['order_id' => $order->id]) }}"
                                                                class="px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-lg h-fit hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-blue-700 dark:focus:ring-gray-800">
                                                                Return/Refund
                                                            </a>
                                                        @endif
                                                    </div>
                                                @elseif ($order->isReturnRefundable())
                                                    <a href="#"
                                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-lg h-fit hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                                        Cancel Return/Refund
                                                    </a>
                                                @elseif($order->isCancellable())
                                                    <button type="button"
                                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-lg h-fit hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                                                        wire:click="cancelOrder('{{ $order->id }}')"
                                                        wire:confirm="Are you sure you want to cancel this order?">
                                                        Cancel
                                                    </button>
                                                @else
                                                    <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </x-shop.section>
</div>
