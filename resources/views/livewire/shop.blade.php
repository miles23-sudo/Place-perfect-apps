<div>
    <x-shop.section :title="$this->selectedCategory ? $this->selectedCategory->name : 'Shop'">
        {{-- Shop Header --}}
        <div
            class="flex items-start justify-between gap-8 max-w-[1720px] mx-auto flex-col lg:flex-row border-b border-bdr-clr dark:border-bdr-clr-drk pb-8 md:pb-[50px]">
            <div>
                <h4 class="font-medium leading-none text-xl sm:text-2xl mb-5 sm:mb-6">Choose Category</h4>
                <div class="flex flex-wrap gap-[10px] md:gap-[15px]">
                    <a class="btn btn-theme-outline btn-sm shop1-button" href="{{ route('shop') }}"
                        data-text="All Categories">
                        <span>All Categories ({{ $this->totalProducts }})</span>
                    </a>
                    @foreach ($this->productCategories as $category)
                        <a class="btn btn-theme-outline btn-sm shop1-button"
                            href="{{ route('shop', ['category' => $category->slug]) }}"
                            data-text=" {{ $category->name }}">
                            <span>{{ $category->name }} ({{ $category->products_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="max-w-[562px] w-full grid sm:grid-cols-2 gap-8 md:gap-12">
                <div>
                    <h4 class="font-medium leading-none text-xl sm:text-2xl mb-5 sm:mb-6">
                        Choose Sort Order
                    </h4>
                    <select class="nice-select outline-select small-select" wire:model.live="sort">
                        <option value="asc">Name, A-Z</option>
                        <option value="desc">Name, Z-A</option>
                        <option value="price_asc">Price, Low to High</option>
                        <option value="price_desc">Price, High to Low</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="paginated-products"
            class="max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]"
            data-aos="fade-up" data-aos-delay="200" wire:ignore.self>

            @forelse ($this->products as $product)
                <x-shop.product-card :product="$product" />
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center">
                    <p class="text-gray-500">No products available at the moment.</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-7 md:mt-12 max-w-[1720px] mx-auto" data-aos="fade-up" data-aos-delay="400"
            wire:ignore>
            {{ $this->products->links(data: ['scrollTo' => false]) }}
        </div>
    </x-shop.section>

    @include('livewire.includes.why-choose-us')
</div>
@script
    <script>
        $(document).ready(function() {
            $('.nice-select').niceSelect('destroy');
        });
    </script>
@endscript
