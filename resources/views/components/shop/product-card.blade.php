@props(['product'])

<div {{ $attributes->merge(['class' => 'group']) }}>
    <div class="relative overflow-hidden">
        <a href="{{ route('product', ['slug' => $product->slug]) }}">
            @if ($product->images && count($product->images))
                @foreach ($product->images as $image)
                    @if ($loop->index < 2)
                        <img class="w-full transform group-hover:scale-110 duration-300"
                            src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
                    @endif
                @endforeach
            @endif
        </a>
        @if ($product->HasArImage())
            <div
                class="absolute z-10 top-7 left-7 pt-[10px] pb-2 px-3 bg-[#E13939] rounded-[30px] font-primary text-[14px] text-white font-semibold leading-none">
                AR Available
            </div>
        @endif

        @if ($product->isNew())
            <div
                class="absolute z-10 top-7 right-7 pt-[10px] pb-2 px-3 bg-[#1CB28E] rounded-[30px] font-primary text-[14px] text-white font-semibold leading-none">
                New
            </div>
        @endif
    </div>
    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
        <h4 class="font-medium leading-none dark:text-white text-lg">
            {{ $product->price_with_currency_symbol }}
        </h4>
        <div>
            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                <a href="{{ route('product', ['slug' => $product->slug]) }}" class="text-underline">
                    {{ $product->name }}
                </a>
            </h5>
            <p class="text-[#6B7280] dark:text-[#9CA3AF] text-sm leading-[1.5]">
                {{ str($product->short_description)->limit(110, preserveWords: true)->toHtmlString() }}
            </p>
        </div>
    </div>
</div>
