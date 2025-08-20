<x-filament-panels::page>
    <div class="flex flex-col gap-6 lg:flex-row">
        <div class="flex-1">
            <x-filament::section>
                <form wire:submit="updateProfile">
                    {{ $this->editProfileForm }}
                    <x-filament::button type="submit" class="mt-4" form="updateProfile">
                        Save
                    </x-filament::button>
                </form>
            </x-filament::section>
        </div>
        <div class="flex-1">
            <x-filament::section>
                <form wire:submit="updateProfileAddress">
                    {{ $this->editProfileAddressForm }}
                    <x-filament::button type="submit" class="mt-4" form="updateProfileAddress">
                        Save
                    </x-filament::button>
                </form>
            </x-filament::section>
        </div>
    </div>
</x-filament-panels::page>
