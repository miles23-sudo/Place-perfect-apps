<div>
    <x-shop.section class="shop-category-area" :title="isset($this->selectedCategory) ? $this->selectedCategory->name : 'Shop'" :subtitle="isset($this->selectedCategory)
        ? str($this->selectedCategory->short_description)->markdown()
        : 'Browse our collection of products'">

        <div class="row">
            <div class="col-lg-3 order-lg-first col-md-12 order-md-last mb-md-60px mb-lm-60px">
                <div class="shop-sidebar-wrap">
                    <div class="sidebar-widget">
                        <div class="main-heading">
                            <h3 class="sidebar-title">Category</h3>
                        </div>
                        <div class="sidebar-widget-category">
                            <ul>
                                <li>
                                    <a href="{{ route('shop') }}" class="selected">
                                        All
                                        <span>({{ $this->totalProducts }})</span>
                                    </a>
                                </li>
                                @forelse ($this->productCategories as $category)
                                    <li wire:key="category-{{ $category->id }}">
                                        <a href="{{ route('shop', ['category' => $category->slug]) }}">
                                            {{ $category->name }}
                                            <span>({{ $category->products_count }})</span>
                                        </a>
                                    </li>
                                @empty
                                    <li>No categories found.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                <div class="shop-top-bar d-flex justify-">
                    <p>There Are {{ $this->products->total() }} Products</p>
                    <div class="select-shoing-wrap d-flex align-items-center">
                        <div class="shot-product">
                            <p>Sort By:</p>
                        </div>
                        <div class="shop-select">
                            <select class="border-0 bg-transparent text-lg my-3 px-3 py-2" wire:model.live="sort">
                                <option value="asc"> Name, A to Z</option>
                                <option value="desc"> Name, Z to A</option>
                                <option value="price_asc"> Price, low to high</option>
                                <option value="price_desc"> Price, high to low</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Shop --}}
                <div class="shop-bottom-area">
                    <div class="row">
                        @forelse ($this->products as $product)
                            <div class="col-lg-4  col-md-6 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-delay="200"
                                wire:key="product-{{ $product->id }}">
                                <div class="product mb-25px">
                                    <div class="thumb">
                                        @if ($product->images)
                                            <a href="{{ route('product', $product->slug) }}" class="image">
                                                @foreach ($product->images as $image)
                                                    @if ($loop->index < 2)
                                                        <img {{ $loop->index == 0 ? '' : 'class=hover-image' }}
                                                            src="{{ asset('storage/' . $image) }}" alt="Product" />
                                                    @endif
                                                @endforeach
                                            </a>
                                        @else
                                            <a href="{{ route('product', $product->slug) }}" class="image">
                                                <img src="{{ asset('sites/images/product-image/default-1.png') }}"
                                                    alt="Default Product" />
                                                <img src="{{ asset('sites/images/product-image/default-2.png') }}"
                                                    alt="Default Product" class="hover-image" />
                                            </a>
                                        @endif
                                        <span class="badges">
                                            <span class="new">New</span>
                                        </span>
                                        <div class="actions">
                                            <a href="wishlist.html" class="action wishlist" title="Wishlist">
                                                <i class="icon-heart"></i>
                                            </a>

                                        </div>
                                        <button title="Add To Cart" class=" add-to-cart">
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
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                - No Products Available -
                            </div>
                        @endforelse
                    </div>

                    {{-- Shop Pagination --}}
                    {{ $this->products->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
    </x-shop.section>
</div>
