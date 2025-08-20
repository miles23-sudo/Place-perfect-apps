@props([
    'name' => null,
    'required' => true,
    'type' => 'text',
    'disabled' => false,
])

<x-shop.checkout.label :name="$name" :required="$required" />
<input
    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
    type="{{ $type }}" placeholder="Enter your {{ str_replace('_', ' ', $name) }}"
    wire:model.lazy="{{ $name }}" @if ($disabled) disabled @endif />
@error($name)
    <span class="mt-1 text-sm text-red-500">
        {{ $message }}
    </span>
@enderror
