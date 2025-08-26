<div>
    <x-shop.section :title="'Order History'">
        <!-- portfolio Navs -->
        <div
            class="max-w-[1720px] mx-auto flex items-start gap-8 md:gap-12 2xl:gap-24 flex-col md:flex-row my-profile-navtab">

            @include('livewire.customer.include.sidebar')

            <div class="w-full overflow-auto md:w-auto md:flex-1">
                <!-- Profile Content -->
                <div class="bg-[#F8F8F9] dark:bg-dark-secondary p-5 sm:p-8 lg:p-[50px] order-history-table">
                    <ul class="order-history">
                        <li
                            class="title flex items-center justify-between gap-5 pb-[10px] sm:pb-5 border-b border-bdr-clr dark:border-bdr-clr-drk">
                            <span
                                class="cart-product-title text-lg md:text-xl font-semibold leading-none text-title dark:text-white block w-[270px] sm:w-[310px] xl:w-[330px]">
                                Product
                            </span>
                            <span
                                class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white w-[100px]">
                                Order #
                            </span>
                            <span
                                class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white w-[60px]">Total
                                Price</span>
                            <span
                                class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white w-[100px]">Status</span>
                        </li>

                        @forelse($this->getOrders as $order)
                            <li
                                class="flex items-center justify-between gap-5 py-[15px] sm:py-[15px] border-b border-bdr-clr dark:border-bdr-clr-drk">
                                <div
                                    class="flex items-center gap-3 md:gap-4 lg:gap-6 ordered-product w-[270px] sm:w-[310px] xl:w-[330px]">
                                    <div class="w-16 sm:w-[90px] flex-none">
                                        <img src="" alt="product">
                                    </div>
                                    <div class="flex-1">
                                        <span class="text-[15px] font-medium leading-none">Interior</span>
                                        <h5 class="mt-2 text-xl font-semibold leading-none md:mt-4">
                                            <a href="#">Modern Sofa Set</a>
                                        </h5>
                                    </div>
                                </div>
                                <span
                                    class="text-base font-semibold leading-none text-left md:text-lg text-title dark:text-white">
                                    {{ $order->id }}
                                </span>
                                <span
                                    class="text-base md:text-lg leading-none text-title dark:text-white font-semibold text-left w-[60px]">
                                    {{ $order->overall_total }}
                                </span>
                                <div class="w-[100px]">
                                    <a href="#" class="bg-[{{ $order->status->getColorHex() }}] py-[7px] px-[10px] font-semibold leading-none text-white text-sm rounded">
                                        {{ $order->status->getLabel() }}
                                    </a>
                                </div>
                            </li>
                        @empty
                            <li class="py-4 text-center text-gray-500" colspan="4">
                                No orders found.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </x-shop.section>
</div>
