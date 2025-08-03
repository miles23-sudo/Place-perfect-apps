@props([
    'name' => null,
    'required' => true,
])

<label class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block">
    {{ ucwords(str_replace('_', ' ', $name)) }}
    @if ($required)
        <span class="text-red-500">*</span>
    @endif
</label>
