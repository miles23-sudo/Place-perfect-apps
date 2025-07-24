<div>
    {{-- Hero Slider --}}
    <div class="section">
        <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
            <div class="swiper-wrapper">
                <div class="hero-slide-item slider-height swiper-slide d-flex">
                    <div class="hero-bg-image">
                        <img src="sites/images/slider-image/slider-2-1.jpg" alt="">
                    </div>
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                <div class="hero-slide-content slider-animated-1">
                                    <span class="category">
                                        Featured Product
                                    </span>
                                    <h2 class="title-1">
                                        Flexible Chair
                                    </h2>
                                    <p>
                                        designed for comfort and style.
                                        It features ergonomic support and a sleek design that fits any workspace.
                                    </p>
                                    <a href="{{ route('shop') }}"
                                        class="btn btn-lg btn-primary btn-hover-dark mt-5">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5">
                                <div class="hero-slide-image">
                                    <img src="sites/images/slider-image/slider-1.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-slide-item slider-height swiper-slide d-flex">
                    <div class="hero-bg-image">
                        <img src="sites/images/slider-image/slider-2-2.jpg" alt="">
                    </div>
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                <div class="hero-slide-content slider-animated-1">
                                    <span class="category">
                                        Featured Product
                                    </span>
                                    <h2 class="title-1">
                                        Soothing Chair
                                    </h2>
                                    <p>
                                        The Flexible Chair is designed to adapt to your body and movements.
                                        It features a unique design that promotes healthy posture and comfort.
                                    </p>
                                    <a href="{{ route('shop') }}"
                                        class="btn btn-lg btn-primary btn-hover-dark mt-5">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5">
                                <div class="hero-slide-image">
                                    <img src="sites/images/slider-image/slider-2.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    {{-- Category --}}
    <div class="section pb-100px pt-100px">
        <div class="container">
            <div class="row">
                @forelse ($this->productCategories as $category)
                    <div class="col-lg-4 col-12 mb-md-30px mb-lm-30px" data-aos="fade-up"
                        data-aos-delay="{{ 200 + $loop->index * 200 }}" wire:key="product-category-{{ $category->id }}">
                        <x-shop.category-card :category="$category" class="mb-4" />
                    </div>
                @empty
                    <div class="col-12 text-center">
                        - No Categories Available -
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Products --}}
    <div id="products" class="section product-tab-area mb-30px">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" data-aos="fade-up">
                    <div class="section-title mb-0">
                        <h2 class="title">Our Products</h2>
                        <p class="sub-title mb-30px">
                            Explore our latest collection of products designed to enhance your lifestyle.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($this->products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                        data-aos-delay="{{ 200 + $loop->index * 200 }}" wire:key="product-{{ $product->id }}">
                        <x-shop.product-card :product="$product" />
                    </div>
                @empty
                    - No Products Available -
                @endforelse
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-30px">
                    <a href="{{ route('shop') }}" class="btn btn-lg btn-primary btn-hover-dark">View All Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
