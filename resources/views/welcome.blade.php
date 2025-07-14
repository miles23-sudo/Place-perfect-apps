@extends('components.layouts.app')

@section('content')
    <div class="section ">
        <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
            <div class="swiper-wrapper">
                <div class="hero-slide-item slider-height swiper-slide d-flex">
                    <div class="hero-bg-image">
                        <img src="template/images/slider-image/slider-2-1.jpg" alt="">
                    </div>
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                <div class="hero-slide-content slider-animated-1">
                                    <span class="category">New Products</span>
                                    <h2 class="title-1">
                                        Office Chair
                                    </h2>
                                    <p>
                                        designed for comfort and style.
                                        It features ergonomic support and a sleek design that fits any workspace.
                                    </p>
                                    <a href="#" class="btn btn-lg btn-primary btn-hover-dark mt-5">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5">
                                <div class="hero-slide-image">
                                    <img src="template/images/slider-image/slider-1.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-slide-item slider-height swiper-slide d-flex">
                    <div class="hero-bg-image">
                        <img src="template/images/slider-image/slider-2-2.jpg" alt="">
                    </div>
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                <div class="hero-slide-content slider-animated-1">
                                    <span class="category">New Products</span>
                                    <h2 class="title-1">
                                        Soothing Chair
                                    </h2>
                                    <p>
                                        The Flexible Chair is designed to adapt to your body and movements.
                                        It features a unique design that promotes healthy posture and comfort.
                                    </p>
                                    <a href="#" class="btn btn-lg btn-primary btn-hover-dark mt-5">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5">
                                <div class="hero-slide-image">
                                    <img src="template/images/slider-image/slider-2.png" alt="" />
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
                <div class="col-lg-4 col-12 mb-md-30px mb-lm-30px" data-aos="fade-up" data-aos-delay="200">
                    <div class="banner-2">
                        <img src="template/images/banner/5.jpg" alt="" />
                        <div class="info justify-content-start">
                            <div class="content align-self-center">
                                <h3 class="title">
                                    New Office Chair <br /> Collection
                                </h3>
                                <a href="shop-left-sidebar.html" class="shop-link">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-md-30px mb-lm-30px" data-aos="fade-up" data-aos-delay="400">
                    <div class="banner-2">
                        <img src="template/images/banner/6.jpg" alt="" />
                        <div class="info justify-content-start">
                            <div class="content align-self-center">
                                <h3 class="title">
                                    Living Room <br /> Collection </h3>
                                <a href="shop-left-sidebar.html" class="shop-link">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="600">
                    <div class="banner-2">
                        <img src="template/images/banner/7.jpg" alt="" />
                        <div class="info justify-content-start">
                            <div class="content align-self-center">
                                <h3 class="title">
                                    Children Room <br /> Collection
                                </h3>
                                <a href="shop-left-sidebar.html" class="shop-link">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <p class="sub-title mb-30px">Torem ipsum dolor sit amet, consectetur adipisicing elitsed do
                            eiusmo tempor incididunt ut labore</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/1.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/2.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">Simple minimal Chair
                                </a>
                            </h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/3.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/4.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="sale">-10%</span>
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">Wooden decorations</a>
                            </h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                                <span class="old">$48.50</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="600">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/5.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/6.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="sale">-7%</span>
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">High quality vase
                                    bottle</a></h5>
                            <span class="price">
                                <span class="new">$30.50</span>
                                <span class="old">$38.00</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="800">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/7.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/8.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">Living & Bedroom
                                    Chair</a></h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-md-30px mb-lm-30px" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/9.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/10.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="sale">-5%</span>
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">Living & Bedroom
                                    Table</a></h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                                <span class="old">$40.50</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6  mb-md-30px mb-lm-30px" data-aos="fade-up"
                    data-aos-delay="400">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/11.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/12.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">Wooden decorations</a>
                            </h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-es-30px" data-aos="fade-up" data-aos-delay="600">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/13.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/14.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">High quality vase
                                    bottle</a></h5>
                            <span class="price">
                                <span class="new">$30.50</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 " data-aos="fade-up" data-aos-delay="800">
                    <div class="product">
                        <div class="thumb">
                            <a href="shop-left-sidebar.html" class="image">
                                <img src="template/images/product-image/15.jpg" alt="Product" />
                                <img class="hover-image" src="template/images/product-image/16.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="" class="action wishlist" title="Wishlist">
                                    <i class="icon-heart"></i>
                                </a>
                                <a href="" class="action compare" title="Compare">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="shop-left-sidebar.html">Living & Bedroom
                                    Chair</a></h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-30px">
                    <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark">View All Products</a>
                </div>
            </div>
        </div>
    </div>
@endsection