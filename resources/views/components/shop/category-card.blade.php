@props(['category'])

<a {{ $attributes->merge(['class' => 'relative block']) }} href="{{ route('shop') . '?category=' . $category->slug }}">
    @if ($category->image)
        <img class="w-full object-cover" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
    @endif
    <div class="absolute bottom-7 left-0 px-5 transform w-full flex justify-start">
        <div class="p-[15px] bg-white dark:bg-title w-auto">
            <span class="md:text-xl text-primary font-medium leading-none">{{ $category->products_count }}
                items
            </span>
            <h4 class="text-xl md:text-2xl mt-[10px] font-semibold leading-[1.5]">
                {{ $category->name }}
            </h4>
        </div>
    </div>
</a>
