@props(['product'])


<div {{ $attributes->merge(['class' => 'group']) }}>
    <div
        class="relative overflow-hidden group z-[5] before:absolute before:w-full before:h-full before:top-0 before:left-0 before:bg-title before:opacity-0 before:duration-300 before:z-[5] hover:before:opacity-80">
        <img class="w-full duration-300 transform group-hover:scale-110"
            src="{{ asset('storage/' . $product->thumbnail()) }}" alt="{{ $product->name }}">

        <div class="absolute z-10 flex gap-2 transform top-1/2 left-1/2 -translate-y-2/4 -translate-x-2/4">
            <a href="javascript:;" wire:click="addToCart({{ $product->id }})"
                class="relative flex items-center justify-center p-2 transition-all transform translate-y-8 bg-white opacity-0 w-9 lg:w-12 h-9 lg:h-12 dark:bg-title bg-opacity-10 group-hover:duration-500 group-hover:opacity-100 group-hover:translate-y-0 tooltip-icon">
                <svg class="text-white fill-current" width="20" height="24" viewBox="0 0 19 23" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.8186 5.5949H15.231C14.8937 2.72995 12.451 0.5 9.49699 0.5C6.54292 0.5 4.10026 2.72995 3.76293 5.5949H1.17532C0.706336 5.5949 0.326172 5.97506 0.326172 6.44405V21.3891C0.326172 21.8581 0.706336 22.2382 1.17532 22.2382H17.8186C18.2876 22.2382 18.6678 21.8581 18.6678 21.3891V6.44405C18.6678 5.97506 18.2876 5.5949 17.8186 5.5949ZM9.49699 2.1983C11.513 2.1983 13.1916 3.66966 13.516 5.5949H5.478C5.80238 3.66966 7.48093 2.1983 9.49699 2.1983ZM16.9695 20.5399H2.02447V7.29319H3.72277V9.84064C3.72277 10.3096 4.10293 10.6898 4.57192 10.6898C5.0409 10.6898 5.42107 10.3096 5.42107 9.84064V7.29319H13.5729V9.84064C13.5729 10.3096 13.9531 10.6898 14.4221 10.6898C14.891 10.6898 15.2712 10.3096 15.2712 9.84064V7.29319H16.9695V20.5399Z" />
                </svg>
                <span
                    class="p-2 bg-white dark:bg-title text-xs text-title dark:text-white absolute -top-[60px] left-1/2 transform -translate-x-1/2 whitespace-nowrap rounded-[4px] opacity-0 invisible duration-300">Add
                    to Cart
                    <span
                        class="w-3 h-3 bg-white dark:bg-title absolute -bottom-[6px] left-1/2 transform -translate-x-1/2 rotate-45"></span>
                </span>
            </a>
            <button
                class="relative flex items-center justify-center p-2 transition-all translate-y-8 bg-white opacity-0 w-9 lg:w-12 h-9 lg:h-12 dark:bg-title bg-opacity-10 group-hover:duration-300 group-hover:opacity-100 group-hover:translate-y-0 tooltip-icon"
                wire:click="removeFromWishlist({{ $product->id }})">
                <svg class="fill-current dark:text-white" width="24" height="22" viewBox="0 0 24 22"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.0961 2.0896C20.8537 0.742126 19.149 0 17.2956 0C15.9102 0 14.6415 0.437988 13.5245 1.3017C12.9609 1.73767 12.4503 2.27106 12 2.89362C11.5499 2.27124 11.0391 1.73767 10.4753 1.3017C9.35852 0.437988 8.08978 0 6.70441 0C4.85101 0 3.14612 0.742126 1.90375 2.0896C0.676208 3.42133 0 5.24066 0 7.21271C0 9.24243 0.756409 11.1004 2.38037 13.06C3.83313 14.8129 5.92108 16.5923 8.33899 18.6528C9.16461 19.3564 10.1005 20.1541 11.0722 21.0037C11.3289 21.2285 11.6583 21.3523 12 21.3523C12.3415 21.3523 12.6711 21.2285 12.9274 21.004C13.8992 20.1542 14.8356 19.3563 15.6616 18.6522C18.0791 16.5921 20.1671 14.8129 21.6198 13.0598C23.2438 11.1004 24 9.24243 24 7.21252C24 5.24066 23.3238 3.42133 22.0961 2.0896Z"
                        fill="#F0264A" />
                </svg>
            </button>
        </div>
    </div>
    <div class="flex flex-col gap-3 pt-5 lg:pt-7 md:gap-4">
        <h4 class="text-lg font-medium leading-none dark:text-white">
            {{ $product->price_with_currency_symbol }}
        </h4>
        <div>
            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                <a href="{{ route('product', ['slug' => $product->slug]) }}" class="text-underline">
                    {{ $product->name }}
                </a>
            </h5>
            <p class="text-[#6B7280] dark:text-[#9CA3AF] text-sm leading-[1.5]">
                {{ str($product->short_description)->limit(110, preserveWords: true)->toHtmlString() }}
            </p>
        </div>
    </div>
</div>
