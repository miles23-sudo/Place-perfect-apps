<div>
    <x-shop.section title="Wishlist">
        <div class="max-w-[1720px] mx-auto flex items-start flex-col md:flex-row">
            @include('livewire.customer.include.sidebar')
            <div class="w-full md:w-auto md:flex-1">
                @if ($this->wishlistItems->isNotEmpty())
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:gap-6 lg::gap-8">
                        @foreach ($this->wishlistItems as $item)
                            <x-shop.product-wishlist-card :product="$item->product" />
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        No item found in your wishlist.
                    </div>
                @endif
            </div>
        </div>
    </x-shop.section>
</div>
