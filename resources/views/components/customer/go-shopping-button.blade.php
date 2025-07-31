<x-filament::button href="{{ route('home') }}" tag="a" icon="ri-bard-line">
    {{ auth('customer')->check() ? 'Go Shopping' : 'Site' }}
</x-filament::button>
