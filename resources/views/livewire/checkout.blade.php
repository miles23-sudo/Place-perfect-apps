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
                        <x-shop.checkout.input name="name" disabled />
                    </div>
                    <div>
                        <x-shop.checkout.input type="email" name="email" disabled />
                    </div>
                    <div>
                        <x-shop.checkout.input type="tel" name="phone_number" disabled />
                    </div>
                    <div>
                        <x-shop.checkout.input type="tel" name="address" disabled />
                    </div>

                    <div>
                        <x-shop.checkout.textarea name="additional_notes" />
                    </div>
                </div>
            </div>
            <div>
                <div
                    class="bg-[#FAFAFA] dark:bg-dark-secondary pt-[30px] md:pt-[40px] lg:pt-[50px] px-[30px] md:px-[40px] lg:px-[50px] pb-[30px] border border-[#17243026] border-opacity-15 rounded-xl">
                    <h4 class="mb-6 text-xl font-semibold leading-none md:text-2xl md:mb-10">
                        Product Information
                    </h4>
                    <div class="grid gap-5 mg:gap-6">

                        @foreach ($this->cartItems as $item)
                            <div class="flex items-center justify-between gap-5">
                                <div class="flex flex-wrap items-center gap-3 md:gap-4 lg:gap-6 cart-product">
                                    <div class="w-16 sm:w-[70px] flex-none">
                                        <img src="{{ asset('storage/' . $item->product->thumbnail()) }}" alt="product">
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="text-lg font-medium leading-none">
                                            {{ $item->product->productCategory->name }}
                                        </h6>
                                        <h5 class="mt-2 text-xl font-semibold leading-none">
                                            <a href="#">
                                                {{ $item->product->name }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                                <h6 class="text-lg font-bold leading-none">
                                    {{ $item->total_with_currency_symbol }}
                                </h6>
                            </div>
                        @endforeach

                    </div>
                    <div
                        class="flex flex-col justify-end w-full pt-6 mt-6 ml-auto mr-0 text-right border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div
                            class="flex flex-wrap justify-between text-base font-medium sm:text-lg text-title dark:text-white">
                            <span>Sub Total:</span>
                            <span>{{ $this->totalPrice }}</span>
                        </div>
                    </div>
                    <div class="pt-6 mt-6 border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div
                            class="flex flex-wrap justify-between mt-3 text-base font-medium sm:text-lg text-title dark:text-white">
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="hidden appearance-none" type="radio" name="item-type">
                                    <span
                                        class="flex items-center justify-center w-4 h-4 duration-300 border rounded-full border-title dark:border-white">
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
                            class="flex flex-wrap justify-between mt-3 text-base font-medium sm:text-lg text-title dark:text-white">
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="hidden appearance-none" type="radio" name="item-type">
                                    <span
                                        class="flex items-center justify-center w-4 h-4 duration-300 border rounded-full border-title dark:border-white">
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
                            class="flex flex-wrap justify-between mt-3 text-base font-medium sm:text-lg text-title dark:text-white">
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="hidden appearance-none" type="radio" name="item-type">
                                    <span
                                        class="flex items-center justify-center w-4 h-4 duration-300 border rounded-full border-title dark:border-white">
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
                    <div class="pt-6 mt-6 border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div class="flex flex-wrap justify-between text-2xl font-semibold leading-none md:text-3xl">
                            <span>Total:</span>
                            <span>&nbsp;{{ $this->totalPrice }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-7 md:mt-12">
                    <h4 class="mb-6 text-xl font-semibold leading-none md:text-2xl md:mb-10">Payment Method</h4>
                    <div class="flex flex-wrap gap-5 sm:gap-8 md:gap-12">
                        @forelse ($this->paymentMethodChoices as $key => $method)
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="hidden appearance-none" type="radio" name="item-type"
                                        value="{{ $key }}" wire:model="payment_method">
                                    <span
                                        class="flex items-center justify-center w-4 h-4 duration-300 border rounded-full border-title dark:border-white">
                                        <svg class="duration-300 opacity-0" width="8" height="8"
                                            viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="5" fill="#BB976D" />
                                        </svg>
                                    </span>
                                    <span
                                        class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">
                                        {{ $method['label'] }}
                                    </span>
                                </label>
                                <p class="ml-6 text-[15px] leading-none mt-2">
                                    {{ $method['description'] }}
                                </p>
                            </div>
                        @empty
                            <div class="w-full text-center">
                                <p class="text-red-500">No payment methods available.</p>
                            </div>
                        @endforelse

                    </div>
                    @error('payment_method')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-wrap gap-3 mt-4 md:mt-6">
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
