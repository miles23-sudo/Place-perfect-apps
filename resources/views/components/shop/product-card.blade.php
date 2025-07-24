@props(['product'])

<div class="product">
    <div class="thumb">
        <a href="{{ route('product', $product->slug) }}" class="image">
            @if ($product->images && count($product->images))
                @foreach ($product->images as $image)
                    @if ($loop->index < 2)
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}"
                            @class([
                                'hover-image' => $loop->index === 1,
                            ]) />
                    @endif
                @endforeach
            @else
                <img src="{{ asset('sites/images/product-image/default-1.png') }}" alt="Default Product" />
                <img src="{{ asset('sites/images/product-image/default-2.png') }}" alt="Default Product"
                    class="hover-image" />
            @endif
        </a>

        <div class="actions">
            <a href="javascript:;" class="action wishlist" title="Wishlist">
                <i class="icon-heart"></i>
            </a>
        </div>

        <button title="Add To Cart" class="add-to-cart">
            Add To Cart
        </button>
    </div>

    <div class="content">
        <h5 class="title">
            <a href="{{ route('product', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h5>

        <span class="price">
            <span class="new">₱{{ number_format($product->price, 2) }}</span>
        </span>
    </div>
</div>
