@props([
    'name' => null,
    'required' => true,
    'options' => [],
])

<x-shop.checkout.label :name="$name" :required="$required" />
<textarea
    class="w-full h-[120px] bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
    name="{{ $name }}" placeholder="Type your {{ str_replace('_', ' ', $name) }}"
    wire:model.lazy="{{ $name }}">
</textarea>
@error($name)
    <span class="text-red-500 text-sm mt-1">
        {{ $message }}
    </span>
@enderror
