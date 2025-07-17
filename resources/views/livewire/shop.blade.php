<div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row breadcrumb_box  align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                            <h2 class="breadcrumb-title">Shop</h2>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <ul class="breadcrumb-list text-center text-md-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item">Shop</li>
                                @if ($selected_category)
                                    <li class=" breadcrumb-item active">{{ $selected_category }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Category --}}
    <div class="shop-category-area pb-100px pt-70px">
        <div class="container">
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
                                    @foreach ($this->productCategories as $category)
                                        <li wire:key="category-{{ $category->id }}">
                                            <a href="{{ route('shop', ['category' => $category->slug]) }}">
                                                {{ $category->name }}
                                                <span>({{ $category->products_count }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                    <div class="shop-top-bar d-flex">
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
                            @foreach ($this->products as $product)
                                <div class="col-lg-4  col-md-6 col-sm-6 col-xs-6" data-aos="fade-up"
                                    data-aos-delay="200" wire:key="product-{{ $product->id }}">
                                    <div class="product mb-25px">
                                        <div class="thumb">
                                            <a href="{{ route('product', $product->slug) }}" class="image">
                                                <img src="{{ asset('sites/images/product-image/1.jpg') }}"
                                                    alt="Product" />
                                                <img class="hover-image"
                                                    src="{{ asset('sites/images/product-image/2.jpg') }}"
                                                    alt="Product" />
                                            </a>
                                            <span class="badges">
                                                <span class="new">New</span>
                                            </span>
                                            <div class="actions">
                                                <a href="wishlist.html" class="action wishlist" title="Wishlist">
                                                    <i class="icon-heart"></i>
                                                </a>
                                                <a href="#" class="action quickview" data-link-action="quickview"
                                                    title="Quick view">
                                                    <i class="icon-size-fullscreen"></i>
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
                                                <span class="new">₱{{ $product->price }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Shop Pagination --}}
                        {{ $this->products->links(data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
