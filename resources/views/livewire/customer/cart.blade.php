<div>
    <x-shop.section title="Cart">
        <div class="container">
            <div class="flex xl:flex-row flex-col gap-[30px] lg:gap-[30px] xl:gap-[70px]">
                <div class="flex-1 overflow-auto">
                    <table id="cart-table" class="responsive nowrap table-wrapper" style="width:100%">
                        <thead class="table-header">
                            <tr>
                                <th class="text-lg font-semibold leading-none md:text-xl text-title dark:text-white">
                                    Product Info
                                </th>
                                <th class="text-lg font-semibold leading-none md:text-xl text-title dark:text-white">
                                    Price
                                </th>
                                <th class="text-lg font-semibold leading-none md:text-xl text-title dark:text-white">
                                    Quantity
                                </th>
                                <th class="text-lg font-semibold leading-none md:text-xl text-title dark:text-white">
                                    Total
                                </th>
                                <th class="text-lg font-semibold leading-none md:text-xl text-title dark:text-white">
                                    Remove
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @forelse ($this->cartItems as $item)
                                <tr wire:key="cart-item-{{ $item->id }}">
                                    <td class="md:w-[42%]">
                                        <div class="flex items-center gap-3 md:gap-4 lg:gap-6 cart-product">
                                            <div class="flex-none w-14 sm:w-20">
                                                <img src="{{ asset('storage/' . $item->product->thumbnail()) }}"
                                                    alt="{{ $item->product->name }}">
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
                                    </td>
                                    <td>
                                        <h6
                                            class="text-base font-semibold leading-none md:text-lg text-title dark:text-white">
                                            ₱{{ $item->price }}
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2 inc-dec" x-data="{
                                            quantity: {{ $item->quantity }},
                                            clamp(val) {
                                                return Math.min(100, Math.max(1, val));
                                            },
                                            updateQuantity() {
                                                this.quantity = this.clamp(this.quantity);
                                                @this.call('updateQuantity', {{ $item->id }}, this.quantity);
                                            }
                                        }"
                                            x-init="$watch('quantity', value => updateQuantity())" wire:ignore>
                                            <button type="button"
                                                class="w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center"
                                                @click="quantity = clamp(quantity - 1)">
                                                <svg class="fill-current text-title dark:text-white" width="14"
                                                    height="2" viewBox="0 0 14 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.4361 0.203613H12.0736L7.81774 0.203615H13.8729V1.80309H7.81774L3.50809 1.80309H1.87053L6.18017 1.80309H0.125V0.203615H6.18017L10.4361 0.203613Z" />
                                                </svg>
                                            </button>
                                            <input
                                                class="w-6 h-auto text-base leading-none text-center bg-transparent outline-none mg:text-lg text-title dark:text-white"
                                                type="number" x-model.number.live="quantity">
                                            <button type="button"
                                                class="w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center"
                                                @click="quantity = clamp(quantity + 1)">
                                                <svg class="fill-current text-title dark:text-white" width="14"
                                                    height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.18017 0.110352H7.81774V6.16553H13.8729V7.76501H7.81774V13.8963H6.18017V7.76501H0.125V6.16553H6.18017V0.110352Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <h6
                                            class="text-base font-semibold leading-none md:text-lg text-title dark:text-white">
                                            ₱{{ $item->total }}
                                        </h6>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center ml-auto duration-300 text-title dark:text-white opacity-50"
                                            @click="$wire.removeItem({{ $item->id }})">
                                            <svg class="fill-current " width="12" height="12" viewBox="0 0 12 12"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.546875 1.70822L1.70481 0.550293L5.98646 4.83195L10.2681 0.550293L11.3991 1.6813L7.11746 5.96295L11.453 10.2985L10.295 11.4564L5.95953 7.12088L1.67788 11.4025L0.546875 10.2715L4.82853 5.98988L0.546875 1.70822Z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center">
                                        Your cart is empty.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>
                    <div
                        class="bg-[#FAFAFA] dark:bg-dark-secondary pt-[30px] md:pt-[40px] px-[30px] md:px-[40px] pb-[30px] border border-[#17243026] border-opacity-15 rounded-xl">
                        <div class="flex flex-wrap justify-between text-2xl font-semibold leading-none">
                            <span>Total:</span>
                            <span>₱{{ $this->totalPrice() }}</span>
                        </div>
                    </div>
                    <div class="sm:mt-[10px] py-5 flex items-end gap-3 flex-wrap justify-end">
                        <a href="{{ route('shop') }}"
                            class="btn btn-sm btn-outline !text-title hover:!text-white before:!z-[-1] dark:!text-white dark:hover:!text-title">
                            Continue Shopping
                        </a>
                        <button type="button" @click="$wire.checkout()"
                            class="btn btn-sm btn-theme-solid !text-white hover:!text-primary before:!z-[-1]">
                            <p class="m-0" wire:loading.remove wire:target="checkout">
                                Checkout
                            </p>
                            <p class="m-0" wire:loading wire:target="checkout">
                                Processing...
                            </p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-shop.section>
</div>
