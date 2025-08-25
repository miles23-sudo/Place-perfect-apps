<x-filament-panels::page>
    <div class="flex flex-col gap-4 md:flex-row">
        {{-- col-9 --}}
        <div class="w-full md:w-3/4">
            {{ $this->table }}
        </div>

        {{-- col-3 --}}
        <div class="w-full md:w-1/4">
            <x-filament::section>
            </x-filament::section>
        </div>
    </div>

</x-filament-panels::page>
