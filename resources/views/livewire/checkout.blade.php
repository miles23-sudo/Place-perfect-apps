<div>
    <x-shop.section title="Checkout">
        <div class="max-w-[1220px] mx-auto grid lg:grid-cols-2 gap-[30px] lg:gap-[70px]">
            <div
                class="bg-[#FAFAFA] dark:bg-dark-secondary p-[30px] md:p-[40px] lg:p-[50px] border border-[#17243026] border-opacity-15 rounded-xl">
                <h4 class="font-semibold leading-none text-xl md:text-2xl mb-6 md:mb-[30px]">
                    Billing Information
                </h4>
                <div class="grid gap-5 md:gap-6">
                    <div>
                        <x-shop.checkout.input name="name" />
                    </div>
                    <div>
                        <x-shop.checkout.input type="email" name="email" />
                    </div>
                    <div>
                        <x-shop.checkout.input type="tel" name="phone_number" />
                    </div>
                    <div class="grid md:grid-cols-2 gap-5 md:gap-6">
                        <div>
                            <x-shop.checkout.input type="text" name="house_number" />
                        </div>
                        <div>
                            <x-shop.checkout.input type="text" name="street" />
                        </div>
                    </div>
                    <div>
                        <x-shop.checkout.select name="region" :options="collect(Arxjei\PSGC::getRegions())->pluck('region_name', 'region_code')" />
                    </div>
                    <div>
                        <x-shop.checkout.select name="province" :options="filled($region)
                            ? collect(Arxjei\PSGC::getAllProvincesByRegionCode($region))->pluck(
                                'province_name',
                                'province_code',
                            )
                            : []" />
                    </div>
                    <div>
                        <x-shop.checkout.select name="city" :options="filled($province)
                            ? collect(Arxjei\PSGC::getAllCitiesByProvinceCode($province))->pluck(
                                'city_name',
                                'city_code',
                            )
                            : []" />
                    </div>
                    <div>
                        <x-shop.checkout.select name="barangay" :options="filled($city)
                            ? collect(Arxjei\PSGC::getAllBarangaysByCityCode($city))->pluck(
                                'barangay_name',
                                'barangay_code',
                            )
                            : []" />
                    </div>
                    <div>
                        <x-shop.checkout.textarea name="additional_notes" />
                    </div>
                </div>
            </div>
            <div>
                <div
                    class="bg-[#FAFAFA] dark:bg-dark-secondary pt-[30px] md:pt-[40px] lg:pt-[50px] px-[30px] md:px-[40px] lg:px-[50px] pb-[30px] border border-[#17243026] border-opacity-15 rounded-xl">
                    <h4 class="font-semibold leading-none text-xl md:text-2xl mb-6 md:mb-10">
                        Product Information
                    </h4>
                    <div class="grid gap-5 mg:gap-6">

                        @foreach ($this->cartItems as $item)
                            <div class="flex items-center justify-between gap-5">
                                <div class="flex items-center gap-3 md:gap-4 lg:gap-6 cart-product flex-wrap">
                                    <div class="w-16 sm:w-[70px] flex-none">
                                        <img src="{{ asset('storage/' . $item->product->thumbnail()) }}" alt="product">
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="leading-none font-medium text-lg">
                                            {{ $item->product->productCategory->name }}
                                        </h6>
                                        <h5 class="font-semibold leading-none mt-2 text-xl">
                                            <a href="#">
                                                {{ $item->product->name }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                                <h6 class="leading-none text-lg font-bold">
                                    {{ $item->total_with_currency_symbol }}
                                </h6>
                            </div>
                        @endforeach

                    </div>
                    <div
                        class="mt-6 pt-6 border-t border-bdr-clr dark:border-bdr-clr-drk text-right flex justify-end flex-col w-full ml-auto mr-0">
                        <div
                            class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium">
                            <span>Sub Total:</span>
                            <span>{{ $this->totalPrice }}</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div
                            class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium mt-3">
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="appearance-none hidden" type="radio" name="item-type">
                                    <span
                                        class="w-4 h-4 rounded-full border border-title dark:border-white flex items-center justify-center duration-300">
                                        <svg class="duration-300 opacity-0" width="8" height="8"
                                            viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="5" fill="#BB976D" />
                                        </svg>
                                    </span>
                                    <span
                                        class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">Free
                                        Shipping:</span>
                                </label>
                            </div>
                            <span> $0</span>
                        </div>
                        <div
                            class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium mt-3">
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="appearance-none hidden" type="radio" name="item-type">
                                    <span
                                        class="w-4 h-4 rounded-full border border-title dark:border-white flex items-center justify-center duration-300">
                                        <svg class="duration-300 opacity-0" width="8" height="8"
                                            viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="5" fill="#BB976D" />
                                        </svg>
                                    </span>
                                    <span
                                        class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">Fast
                                        Shipping:</span>
                                </label>
                            </div>
                            <span>$10</span>
                        </div>
                        <div
                            class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium mt-3">
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="appearance-none hidden" type="radio" name="item-type">
                                    <span
                                        class="w-4 h-4 rounded-full border border-title dark:border-white flex items-center justify-center duration-300">
                                        <svg class="duration-300 opacity-0" width="8" height="8"
                                            viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="5" fill="#BB976D" />
                                        </svg>
                                    </span>
                                    <span
                                        class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">
                                        Local Pickup:
                                    </span>
                                </label>
                            </div>
                            <span>$15</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div class="flex justify-between flex-wrap font-semibold leading-none text-2xl md:text-3xl">
                            <span>Total:</span>
                            <span>&nbsp;{{ $this->totalPrice }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-7 md:mt-12">
                    <h4 class="font-semibold leading-none text-xl md:text-2xl mb-6 md:mb-10">Payment Method</h4>
                    <div class="flex gap-5 sm:gap-8 md:gap-12 flex-wrap">
                        <div>
                            <label class="flex items-center gap-[10px] categoryies-iteem">
                                <input class="appearance-none hidden" type="radio" name="item-type">
                                <span
                                    class="w-4 h-4 rounded-full border border-title dark:border-white flex items-center justify-center duration-300">
                                    <svg class="duration-300 opacity-0" width="8" height="8"
                                        viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="10" height="10" rx="5" fill="#BB976D" />
                                    </svg>
                                </span>
                                <span
                                    class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">
                                    Cash On Delivery
                                </span>
                            </label>
                            <p class="ml-6 text-[15px] leading-none mt-2">
                                Pay when you receive the product.
                            </p>
                        </div>
                        <div>
                            <label class="flex items-center gap-[10px] categoryies-iteem">
                                <input class="appearance-none hidden" type="radio" name="item-type">
                                <span
                                    class="w-4 h-4 rounded-full border border-title dark:border-white flex items-center justify-center duration-300">
                                    <svg class="duration-300 opacity-0" width="8" height="8"
                                        viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="10" height="10" rx="5" fill="#BB976D" />
                                    </svg>
                                </span>
                                <span
                                    class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">
                                    Card/Bank
                                </span>
                            </label>
                            <p class="ml-6 text-[15px] leading-none mt-2">
                                Visa, Mastercard
                            </p>
                        </div>
                        <div>
                            <label class="flex items-center gap-[10px] categoryies-iteem">
                                <input class="appearance-none hidden" type="radio" name="item-type">
                                <span
                                    class="w-4 h-4 rounded-full border border-title dark:border-white flex items-center justify-center duration-300">
                                    <svg class="duration-300 opacity-0" width="8" height="8"
                                        viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="10" height="10" rx="5" fill="#BB976D" />
                                    </svg>
                                </span>
                                <span
                                    class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">
                                    E-Wallet
                                </span>
                            </label>
                            <p class="ml-6 text-[15px] leading-none mt-2">
                                Gcash, Maya
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('cart') }}"
                            class="btn btn-outline !text-title hover:!text-white before:!z-[-1] dark:!text-white dark:hover:!text-title">
                            Back to Cart
                        </a>
                        <button type="button" @click="$wire.placeOrder()"
                            class="btn btn-theme-solid !text-white hover:!text-primary before:!z-[-1]">
                            <p class="m-0" wire:loading.remove wire:target="placeOrder">
                                Place Order
                            </p>
                            <p class="m-0" wire:loading wire:target="placeOrder">
                                Processing...
                            </p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-shop.section>
</div>
@script
    <script>
        $(document).ready(function() {
            $('.nice-select').niceSelect('destroy');
        });
    </script>
@endscript
