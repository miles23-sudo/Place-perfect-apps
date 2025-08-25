<div>
    <x-shop.section title="Account">
        <div
            class="max-w-[1720px] mx-auto flex items-start gap-8 md:gap-12 2xl:gap-24 flex-col md:flex-row my-profile-navtab">

            @include('livewire.customer.include.sidebar')

            <div class="w-full overflow-auto md:w-auto md:flex-1">
                <form class="w-full max-w-[951px] bg-[#F8F8F9] dark:bg-dark-secondary p-5 sm:p-8 lg:p-[50px]"
                    wire:submit="updateProfile">
                    <div class="flex flex-col items-start gap-5 lg:flex-row sm:gap-6">
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    Name
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                    type="text" placeholder="Enter your name" wire:model.lazy="name">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">Email</label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                    type="email" placeholder="Enter your email" wire:model.lazy="email">
                                @error('email')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    Phone Number
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300 appearance-none"
                                    type="tel" placeholder="Type your phone number" wire:model.lazy="phone_number">
                                @error('phone_number')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-8 md:mt-12">
                        <button type="submit" class="btn btn-solid" data-text="Save Change">
                            <span>Save Change</span>
                        </button>
                    </div>
                </form>
                <form class="w-full max-w-[951px] bg-[#F8F8F9] dark:bg-dark-secondary p-5 sm:p-8 lg:p-[50px] mt-3"
                    wire:submit="updateAddress">
                    <div class="flex flex-col items-start gap-5 sm:gap-6">
                        <div class="w-full">
                            <label
                                class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                Address
                            </label>
                            <input
                                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                type="address" placeholder="Enter your address" wire:model.lazy="address">
                            @error('address')
                                <div class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label
                                class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                Location
                            </label>
                            <gmp-map center="37.4220656,-122.0840897" zoom="10" map-id="DEMO_MAP_ID"
                                style="height: 400px"></gmp-map>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-8 md:mt-12">
                        <button type="submit" class="btn btn-solid" data-text="Save Change">
                            <span>Save Change</span>
                        </button>
                    </div>
                </form>
                <form class="w-full max-w-[951px] bg-[#F8F8F9] dark:bg-dark-secondary p-5 sm:p-8 lg:p-[50px] mt-3"
                    wire:submit="resetPassword">
                    <div class="flex flex-col items-start gap-5 lg:flex-row sm:gap-6">
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    Old Password
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                    type="password" placeholder="* * * * * * * *" wire:model="old_password"
                                    autocomplete>
                                @error('old_password')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    New Password
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300 appearance-none"
                                    type="password" placeholder="* * * * * * * *" wire:model="new_password"
                                    autocomplete>
                                @error('new_password')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-8 md:mt-12">
                        <button type="submit" class="btn btn-solid" data-text="Save Change">
                            <span>Save Change</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-shop.section>
</div>

@assets
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPLob2osj6xKDVQkMBxjWOaeJTuKtVmEI&libraries=maps&v=beta"
        defer></script>
@endassets

@script
    <script>
        async function initMap() {
            console.log("Maps JavaScript API loaded.");
        }
    </script>
@endscript
