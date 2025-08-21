<x-filament-panels::page>
    <x-filament::section aside>
        <x-slot name="heading">
            Profile Information
        </x-slot>
        <x-slot name="description">
            This is all the information we hold about the user.
        </x-slot>
        <form wire:submit="updateProfile">
            {{ $this->editProfileForm }}
            <x-filament::button type="submit" class="mt-4" form="updateProfile">
                Save
            </x-filament::button>
        </form>
    </x-filament::section>
    <x-filament::section aside>
        <x-slot name="heading">
            Shipping Address
        </x-slot>
        <x-slot name="description">
            This is all the information we hold about the user's shipping address.
        </x-slot>
        <form wire:submit="updateProfileAddress">
            {{ $this->editProfileAddressForm }}
            <x-filament::button type="submit" class="mt-4" form="updateProfileAddress">
                Save
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-panels::page>
