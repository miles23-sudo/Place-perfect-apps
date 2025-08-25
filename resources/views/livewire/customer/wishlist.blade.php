<div>
    <x-shop.section :title="'Wishlist'">
        <div
            class="max-w-[1720px] mx-auto flex items-start gap-8 md:gap-12 2xl:gap-24 flex-col md:flex-row my-profile-navtab">

            @include('livewire.customer.include.sidebar')

            <div class="w-full md:w-auto md:flex-1">
                {{-- <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 sm:gap-6 lg::gap-8">

                </div> --}}
                No item found in your wishlist.
            </div>
        </div>
    </x-shop.section>
</div>
