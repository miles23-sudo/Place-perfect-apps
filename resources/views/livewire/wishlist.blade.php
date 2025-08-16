<div>
    <x-shop.section title="Wishlist">
        <div class="max-w-[1720px] mx-auto flex items-start flex-col md:flex-row">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:gap-6 lg::gap-8">

                @forelse($this->wishlistItems as $item)
                    <x-shop.product-wishlist-card :product="$item->product" />
                @empty
                    <div class="col-span-4 py-8 text-center">
                        <p class="text-lg font-semibold text-title dark:text-white">Your wishlist is empty.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </x-shop.section>
</div>
