<div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row breadcrumb_box  align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                            <h2 class="breadcrumb-title">
                                {{ $this->product->name }}
                            </h2>
                            <p>
                                {!! str($this->product->short_description)->markdown() !!}
                            </p>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <ul class="breadcrumb-list text-center text-md-end">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Product Details
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Images - Short Description --}}
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <div class="swiper-container zoom-top position-relative">
                        <div class="swiper-wrapper">
                            @foreach ($this->product->images as $image)
                                <div class="swiper-slide zoom-image-hover" wire:key="product-image-{{ $image }}">
                                    <img class="img-responsive m-auto" src="{{ asset('storage/' . $image) }}"
                                        alt="Product Image" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-container zoom-thumbs slider-nav-style-1 small-nav mt-15px mb-15px">
                        <div class="swiper-wrapper">
                            @foreach ($this->product->images as $image)
                                <div class="swiper-slide" wire:key="product-thumbnail-{{ $image }}">
                                    <img class="img-responsive m-auto" src="{{ asset('storage/' . $image) }}"
                                        alt="">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-buttons">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content">
                        <h2>
                            {{ $this->product->name }}
                        </h2>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                            </div>
                            <span class="read-review"><a class="reviews" href="#">Read reviews (1)</a></span>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">
                                    ₱{{ number_format($this->product->price, 2) }}
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                            </div>
                            <div class="pro-details-cart">
                                <button class="add-cart btn btn-primary btn-hover-primary ml-4" href="#">
                                    Add To Cart
                                </button>
                            </div>
                        </div>

                        <div class="pro-details-social-info">
                            <div class="pro-details-wish-com">
                                <div class="pro-details-wishlist">
                                    <a href="#">
                                        <i class="ion-android-favorite-outline"></i>
                                        Add to wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if ($this->product->ar_image)
                            <model-viewer class="action" class="action wishlist"
                                src="{{ asset('storage/' . $this->product->ar_image) }}" shadow-intensity="1" ar
                                camera-controls touch-action="pan-y" disable-zoom alt="{{ $this->product->name }}">
                            </model-viewer>
                        @endif
                        <div class="pro-details-policy">
                            <ul>
                                <li><img src="{{ asset('sites/images/icons/policy.png') }}"
                                        alt="" /><span>Security
                                        Policy (Edit With
                                        Customer Reassurance Module)</span></li>
                                <li><img src="{{ asset('sites/images/icons/policy-2.png') }}"
                                        alt="" /><span>Delivery
                                        Policy (Edit
                                        With Customer Reassurance Module)</span></li>
                                <li><img src="{{ asset('sites/images/icons/policy-3.png') }}"
                                        alt="" /><span>Return
                                        Policy (Edit With
                                        Customer Reassurance Module)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Descriptions --}}
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details2">Product Details</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews (1)</a>
                </div>
                <div class="tab-content description-review-bottom">

                    {{-- Description --}}
                    <div id="des-details1" class="tab-pane">
                        <div class="product-description-wrapper">
                            {!! str($this->product->description)->markdown() !!}
                        </div>
                    </div>

                    {{-- Product Details --}}
                    <div id="des-details2" class="tab-pane active">
                        <div class="product-anotherinfo-wrapper">
                            <ul>
                                @foreach ($this->product->features as $feature => $value)
                                    <li>
                                        <span>{{ ucfirst($feature) }}</span> {{ ucfirst($value) }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Reviews --}}
                    <div id="des-details3" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('sites/images/review-image/1.png') }}"
                                                alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>
                                                    Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula. Phasellus quam nisi, congue id nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @auth
                                <div class="col-lg-5">
                                    <div class="ratting-form-wrapper pl-50">
                                        <h3>Add a Review</h3>
                                        <div class="ratting-form">
                                            <form action="#">
                                                <div class="star-box">
                                                    <span>Your rating:</span>
                                                    <div class="rating-product">
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                        <i class="ion-android-star"></i>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="rating-form-style form-submit">
                                                            <textarea name="Your Review" placeholder="Message"></textarea>
                                                            <button class="btn btn-primary btn-hover-color-primary "
                                                                type="submit" value="Submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-5">
                                    <div class="alert alert-dark text-lg rounded-0" role="alert">
                                        Please <a href="{{ route('auth.login') }}" class="alert-link">login</a> to add a
                                        review.
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- You May Also Like --}}
    <div class="section pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-start mb-11">
                        <h2 class="title">You Might Also Like</h2>
                    </div>
                </div>
            </div>

            <div class="new-product-slider swiper-container slider-nav-style-1" data-aos="fade-up"
                data-aos-delay="200">
                <div class="new-product-wrapper swiper-wrapper">
                    @forelse ($this->productRecommendations as $product_recommendation)
                        <div class="new-product-item swiper-slide"
                            wire:key="product-recommendation-{{ $product_recommendation->id }}">
                            <div class="product">
                                <div class="thumb">
                                    <a href="{{ route('product', $product_recommendation->slug) }}" class="image">
                                        <img src="{{ asset('sites/images/product-image/1.jpg') }}" alt="Product" />
                                        <img class="hover-image"
                                            src="{{ asset('sites/images/product-image/2.jpg') }}" alt="Product" />
                                    </a>
                                    <div class="actions">
                                        <a href="#" class="action wishlist" title="Wishlist">
                                            <i class="icon-heart"></i>
                                        </a>
                                        <a href="#" class="action quickview" title="Quick view">
                                            <i class="icon-size-fullscreen"></i>
                                        </a>
                                    </div>
                                    <button title="Add To Cart" class=" add-to-cart">
                                        Add To Cart
                                    </button>
                                </div>
                                <div class="content">
                                    <h5 class="title">
                                        <a href="{{ route('product', $product_recommendation->slug) }}">
                                            {{ $product_recommendation->name }}
                                        </a>
                                    </h5>
                                    <span class="price">
                                        <span
                                            class="new">₱{{ number_format($product_recommendation->price, 2) }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            - No Recommendations Available -
                        </div>
                    @endforelse
                </div>
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
@endassets


@script
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modelViewers = document.querySelectorAll('model-viewer');
            modelViewers.forEach((modelViewer) => {
                modelViewer.addEventListener('click', () => {
                    modelViewer.show();
                });
            });
        });
    </script>
@endscript
