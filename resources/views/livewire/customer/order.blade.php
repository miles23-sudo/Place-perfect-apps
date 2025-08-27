<div>
    <x-shop.section :title="'Order History'">
        <div
            class="max-w-[1720px] mx-auto flex items-start gap-8 md:gap-12 2xl:gap-24 flex-col md:flex-row my-profile-navtab">

            @include('livewire.customer.include.sidebar')

            <div class="w-full overflow-hidden md:w-auto md:flex-1">
                <div class="bg-[#F8F8F9] dark:bg-dark-secondary p-4 md:p-6 lg:p-8 order-history-table">

                    <!-- Responsive Table -->
                    <div class="overflow-x-auto">
                        <table class="order-history w-full min-w-[750px] text-sm border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr class="text-left">
                                    <th class="px-4 py-3 font-semibold text-title dark:text-white">Product</th>
                                    <th class="px-2 py-3 font-semibold text-title dark:text-white">Item No.</th>
                                    <th class="px-2 py-3 font-semibold text-title dark:text-white">Order #</th>
                                    <th class="px-2 py-3 font-semibold text-title dark:text-white">Payment</th>
                                    <th class="px-2 py-3 font-semibold text-title dark:text-white">Total</th>
                                    <th class="px-2 py-3 font-semibold text-title dark:text-white">Status</th>
                                    <th class="px-2 py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($this->getOrders as $order)
                                    <tr
                                        class="border-b border-bdr-clr dark:border-bdr-clr-drk hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="px-4 py-3">
                                            @foreach ($order->items as $item)
                                                @if ($loop->first)
                                                    <div class="flex items-center gap-3">
                                                        <div class="flex-none w-11 h-11">
                                                            <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                                alt="product"
                                                                class="object-cover w-full h-full rounded">
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p
                                                                class="text-xs text-gray-500 truncate dark:text-gray-400">
                                                                {{ $item->product->productCategory->name }}
                                                            </p>
                                                            <h5
                                                                class="text-sm font-semibold truncate text-title dark:text-white">
                                                                {{ $item->product->name }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-2 py-3 font-medium text-center text-title dark:text-white">
                                            {{ $order->items->count() }}
                                        </td>
                                        <td
                                            class="px-2 py-3 text-xs text-gray-700 dark:text-gray-300 truncate max-w-[140px]">
                                            {{ $order->id }}
                                        </td>
                                        <td class="px-2 py-3">
                                            <span>
                                                <x-icon :name="$order->payment_mode->getIcon()" class="w-4 h-4" />
                                                {{ $order->payment_mode->getLabel() }}
                                            </span>
                                        </td>
                                        <td class="px-2 py-3 font-medium text-title dark:text-white">
                                            ₱{{ $order->overall_total }}
                                        </td>
                                        <td class="px-2 py-3">
                                            <span
                                                class="inline-flex items-center gap-1 py-1.5 px-3 text-xs sm:text-sm font-medium text-white rounded-full"
                                                style="background-color: {{ $order->status->getColorHex() }};">
                                                <x-icon :name="$order->status->getIcon()" class="w-4 h-4" />
                                                {{ $order->status->getLabel() }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-2 py-3">
                                            @if ($order->isToReceive())
                                                <button type="button"
                                                    class="bg-primary-600 text-white py-1.5 px-3 rounded-md hover:opacity-90 text-xs sm:text-sm"
                                                    wire:click="markAsReceived('{{ $order->id }}')"
                                                    wire:confirm="Are you sure you want to mark this order as received?">
                                                    Mark as Received
                                                </button>
                                            @elseif ($order->isDelivered())
                                                <div class="flex gap-2">
                                                    <a href="{{ route('customer.review', ['order_id' => $order->id]) }}"
                                                        class="bg-[#bb976d] text-white py-1.5 px-3 rounded-md hover:opacity-90 text-xs sm:text-sm">
                                                        Review
                                                    </a>
                                                    <button type="button"
                                                        class="text-[#bb976d] py-1.5 px-3 rounded-md hover:opacity-90 text-xs sm:text-sm">
                                                        Request Return
                                                    </button>
                                                </div>
                                            @elseif($order->isCancellable())
                                                <button type="button"
                                                    class="text-[#bb976d] py-1.5 px-3 rounded-md hover:opacity-90 text-xs sm:text-sm"
                                                    wire:click="cancelOrder('{{ $order->id }}')"
                                                    wire:confirm="Are you sure you want to cancel this order?">
                                                    Cancel Order
                                                </button>
                                            @else
                                                <span class="text-xs text-gray-500">No actions</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-6 text-center text-gray-500">No orders found.</td>
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
