<div>
    <x-shop.section :title="'Order History'">
        <!-- portfolio Navs -->
        <div
            class="max-w-[1720px] mx-auto flex items-start gap-8 md:gap-12 2xl:gap-24 flex-col md:flex-row my-profile-navtab">

            @include('livewire.customer.include.sidebar')

            <div class="w-full overflow-hidden md:w-auto md:flex-1">
                <div class="bg-[#F8F8F9] dark:bg-dark-secondary p-3 sm:p-4 md:p-6 lg:p-8 order-history-table">
                    <div class="block md:hidden space-y-4">
                        @forelse($this->getOrders as $order)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-bdr-clr dark:border-bdr-clr-drk">
                                <!-- Product Info -->
                                <div class="mb-4">
                                    @foreach ($order->items as $item)
                                        @if ($loop->first)
                                            <div class="flex items-start gap-3 ordered-product">
                                                <div class="w-12 h-12 flex-none">
                                                    <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                        alt="product" class="w-full h-full object-cover rounded">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <span
                                                        class="text-xs font-medium text-gray-600 dark:text-gray-400 block">
                                                        {{ $item->product->productCategory->name }}
                                                    </span>
                                                    <h5
                                                        class="mt-1 text-sm font-semibold leading-tight text-title dark:text-white">
                                                        <a href="javascript:void(0)">{{ $item->product->name }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Order Details Grid -->
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-400 block mb-1">Item No.</span>
                                        <span
                                            class="font-semibold text-title dark:text-white">{{ $order->items->count() }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-400 block mb-1">Order #</span>
                                        <span
                                            class="font-semibold text-title dark:text-white">{{ $order->id }}</span>
                                    </div>
                                    <div class="col-span-2">
                                        <span class="text-gray-600 dark:text-gray-400 block mb-2">Payment Mode</span>
                                        <span
                                            class="inline-flex items-center gap-1 py-1.5 px-2.5 font-semibold leading-none text-white text-xs rounded"
                                            style="background-color: {{ $order->payment_mode->getColorHex() }};">
                                            <x-icon :name="$order->payment_mode->getIcon()" class="w-3 h-3" />
                                            {{ $order->payment_mode->getLabel() }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-400 block mb-1">Total</span>
                                        <span
                                            class="font-semibold text-title dark:text-white">₱{{ $order->overall_total }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-400 block mb-2">Status</span>
                                        <button type="button"
                                            class="inline-flex items-center gap-1 py-1.5 px-2.5 font-semibold leading-none text-white text-xs rounded"
                                            style="background-color: {{ $order->status->getColorHex() }};">
                                            <x-icon :name="$order->status->getIcon()" class="w-3 h-3" />
                                            {{ $order->status->getLabel() }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500 text-base">No orders found.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Desktop Table View (Hidden on mobile) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="order-history w-full min-w-[800px]">
                            <thead>
                                <tr class="border-b border-bdr-clr dark:border-bdr-clr-drk">
                                    <th
                                        class="cart-product-title text-sm lg:text-base font-semibold leading-none text-title dark:text-white text-left pb-3 lg:pb-4 w-[280px] lg:w-[320px] pr-4">
                                        Product
                                    </th>
                                    <th
                                        class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white text-left pb-3 lg:pb-4 w-[80px] px-2">
                                        Item No.
                                    </th>
                                    <th
                                        class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white text-left pb-3 lg:pb-4 w-[100px] px-2">
                                        Order #
                                    </th>
                                    <th
                                        class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white text-left pb-3 lg:pb-4 w-[140px] px-2">
                                        Payment Mode
                                    </th>
                                    <th
                                        class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white text-left pb-3 lg:pb-4 w-[100px] px-2">
                                        Total
                                    </th>
                                    <th
                                        class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white text-left pb-3 lg:pb-4 w-[120px] pl-2">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($this->getOrders as $order)
                                    <tr
                                        class="border-b border-bdr-clr dark:border-bdr-clr-drk hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="py-3 lg:py-4 w-[280px] lg:w-[320px] pr-4">
                                            @foreach ($order->items as $item)
                                                @if ($loop->first)
                                                    <div class="flex items-center gap-3 lg:gap-4 ordered-product">
                                                        <div class="w-12 h-12 lg:w-16 lg:h-16 flex-none">
                                                            <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                                alt="product"
                                                                class="w-full h-full object-cover rounded">
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <span
                                                                class="text-xs lg:text-sm font-medium leading-none text-gray-600 dark:text-gray-400 block">
                                                                {{ $item->product->productCategory->name }}
                                                            </span>
                                                            <h5
                                                                class="mt-1.5 lg:mt-2 text-sm lg:text-base font-semibold leading-tight text-title dark:text-white">
                                                                <a href="javascript:void(0)"
                                                                    class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                                    {{ $item->product->name }}
                                                                </a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="py-3 lg:py-4 px-2">
                                            <span
                                                class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white">
                                                {{ $order->items->count() }}
                                            </span>
                                        </td>
                                        <td class="py-3 lg:py-4 px-2">
                                            <span
                                                class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white">
                                                {{ $order->id }}
                                            </span>
                                        </td>
                                        <td class="py-3 lg:py-4 px-2">
                                            <span
                                                class="inline-flex items-center gap-1.5 py-2 px-3 font-semibold leading-none text-white text-xs lg:text-sm rounded-md whitespace-nowrap"
                                                style="background-color: {{ $order->payment_mode->getColorHex() }};">
                                                <x-icon :name="$order->payment_mode->getIcon()" class="w-3.5 h-3.5 lg:w-4 lg:h-4" />
                                                {{ $order->payment_mode->getLabel() }}
                                            </span>
                                        </td>
                                        <td class="py-3 lg:py-4 px-2">
                                            <span
                                                class="text-sm lg:text-base font-semibold leading-none text-title dark:text-white">
                                                ₱{{ $order->overall_total }}
                                            </span>
                                        </td>
                                        <td class="py-3 lg:py-4 pl-2">
                                            <button type="button"
                                                class="inline-flex items-center gap-1.5 py-2 px-3 font-semibold leading-none text-white text-xs lg:text-sm rounded-md hover:opacity-90 transition-opacity whitespace-nowrap"
                                                style="background-color: {{ $order->status->getColorHex() }};">
                                                <x-icon :name="$order->status->getIcon()" class="w-3.5 h-3.5 lg:w-4 lg:h-4" />
                                                {{ $order->status->getLabel() }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-8 text-center text-gray-500 text-base" colspan="6">
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
