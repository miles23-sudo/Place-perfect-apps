<x-filament::button href="{{ route('home') }}" tag="a">
    {{ auth('customer')->check() ? 'Go Shopping' : 'Site' }}
</x-filament::button>
