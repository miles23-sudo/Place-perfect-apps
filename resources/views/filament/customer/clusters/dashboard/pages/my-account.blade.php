<x-filament-panels::page>
    <x-filament::section>
        <form wire:submit="create">
            {{ $this->form }}
            <x-filament::button type="submit" class="mt-4">
                Save
            </x-filament::button>
        </form>
    </x-filament::section>

    <x-filament-actions::modals />
</x-filament-panels::page>
