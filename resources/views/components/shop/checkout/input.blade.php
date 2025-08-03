@props([
    'name' => null,
    'required' => true,
    'type' => 'text',
])

<x-shop.checkout.label :name="$name" :required="$required" />
<input
    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
    type="{{ $type }}" placeholder="Enter your {{ $name }}" wire:model.lazy="{{ $name }}" />
@error($name)
    <span class="text-red-500 text-sm mt-1">
        {{ $message }}
    </span>
@enderror
