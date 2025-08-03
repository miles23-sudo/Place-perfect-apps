@props([
    'name' => null,
    'required' => true,
    'options' => [],
])

<x-shop.checkout.label :name="$name" :required="$required" />
<select class="nice-select select-active p-4 !bg-white dark:!bg-dark-secondary" wire:model.lazy="{{ $name }}">
    <option>Select an option</option>
    @if (filled($options))
        @foreach ($options as $option => $value)
            <option value="{{ $option }}" wire:key="option-{{ $option }}">{{ $value }}</option>
        @endforeach
    @endif
</select>
@error($name)
    <span class="text-red-500 text-sm mt-1">
        {{ $message }}
    </span>
@enderror
