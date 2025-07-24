@props(['category'])

<div {{ $attributes->merge(['class' => 'banner-2']) }}>
    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
            wire:key="category-image-{{ $category->id }}" />
    @else
        <img src="{{ asset('sites/images/category-image/default.png') }}" alt="default-category" />
    @endif

    <div class="info justify-content-start">
        <div class="content align-self-center">
            <h3 class="title">{{ $category->name }}</h3>
            <a href="{{ route('shop', ['category' => $category->slug]) }}" class="shop-link">
                View Products
            </a>
        </div>
    </div>
</div>
