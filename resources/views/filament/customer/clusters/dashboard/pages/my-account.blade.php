<x-filament-panels::page>
    @if (!auth('customer')->user()->hasShippingAddress())
        <x-filament::section
            class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-300 dark:border-yellow-700 rounded-2xl shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div
                    class="flex items-center justify-center w-12 h-12 bg-yellow-100 dark:bg-yellow-800 rounded-full shrink-0">
                    <x-ri-error-warning-line class="w-6 h-6 text-yellow-600 dark:text-yellow-300" />
                </div>
                <div class="text-left">
                    <div class="text-xl font-semibold text-yellow-800 dark:text-yellow-200">
                        Shipping Address Missing
                    </div>
                    <div class="mt-1 text-sm text-yellow-700 dark:text-yellow-300">
                        You haven’t set up your shipping address yet. This may delay your orders.
                        Please complete your shipping details to proceed.
                        <x-filament::link
                            class="underline font-medium text-yellow-800 dark:text-yellow-300 hover:text-yellow-900 dark:hover:text-yellow-100 transition"
                            :href="App\Filament\Customer\Clusters\Dashboard\Pages\ShippingAddress::getUrl()">
                            Click here to set it up.
                        </x-filament::link>
                    </div>
                </div>
            </div>
        </x-filament::section>
    @endif

    <x-filament::section>
        <form wire:submit="create">
            {{ $this->form }}
            <x-filament::button type="submit" class="mt-4" form="create">
                Save
            </x-filament::button>
        </form>
    </x-filament::section>

    <x-filament-actions::modals />
</x-filament-panels::page>
