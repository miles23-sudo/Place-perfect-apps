<div>
    <x-shop.section class="section" :title="$this->product->name">
        <div class="row">
            <div class="col-lg-5 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px" wire:ignore>
                <div class="swiper-container zoom-top position-relative">
                    <div class="swiper-wrapper">
                        @if ($this->product->images)
                            @foreach ($this->product->images as $image)
                                <div class="swiper-slide zoom-image-hover" wire:key="product-image-{{ $image }}">
                                    <img class="img-responsive m-auto" src="{{ asset('storage/' . $image) }}"
                                        alt="Product Image" />
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide zoom-image-hover" wire:key="product-image-placeholder-1">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('sites/images/product-image/default-1.png') }}"
                                    alt="Default Product" />
                            </div>
                            <div class="swiper-slide zoom-image-hover" wire:key="product-image-placeholder-2">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('sites/images/product-image/default-2.png') }}"
                                    alt="Default Product" />
                            </div>
                        @endif
                    </div>
                </div>
                <div class="swiper-container zoom-thumbs slider-nav-style-1 small-nav mt-15px mb-15px">
                    <div class="swiper-wrapper">
                        @if ($this->product->images)
                            @foreach ($this->product->images as $image)
                                <div class="swiper-slide" wire:key="product-thumbnail-{{ $image }}">
                                    <img class="img-responsive m-auto" src="{{ asset('storage/' . $image) }}"
                                        alt="">
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide" wire:key="product-thumbnail-placeholder-1">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('sites/images/product-image/default-1.png') }}" alt="">
                            </div>
                            <div class="swiper-slide" wire:key="product-thumbnail-placeholder-2">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('sites/images/product-image/default-1.png') }}" alt="">
                            </div>
                        @endif

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
                            {!! $this->product->renderStars() !!}
                        </div>
                        <span class="read-review">
                            <a class="reviews" href="#des-details3">Read reviews
                                ({{ floatval($this->productFeedbacks->avg('rating')) }})</a>
                            </a>
                        </span>
                    </div>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut">
                                ₱{{ number_format($this->product->price, 2) }}
                            </li>
                        </ul>
                    </div>
                    <form class="pro-details-quality mb-2" x-data="{ quantity: 1 }"
                        @submit.prevent="$wire.set('quantity', quantity); $wire.call('addToCart')">
                        <div class="d-flex align-items-center border" wire:ignore>
                            <button type="button" class="btn btn-light bg-transparent w-auto px-2"
                                @click="quantity = quantity > 1 ? quantity - 1 : 1">
                                -
                            </button>
                            <input type="text" class="border-0 rounded-0 p-0 text-center" style="width: 50px;"
                                x-model.number="quantity" name="quantity" />
                            <button type="button" class="btn btn-light bg-transparent w-auto px-2" @click="quantity++">
                                +
                            </button>
                        </div>
                        <div class="pro-details-cart">
                            <button type="submit" class="add-cart btn btn-primary btn-hover-primary">
                                Add To Cart
                            </button>
                        </div>
                    </form>

                    @error('quantity')
                        <small class="text-danger text-sm">{{ $message }}</small>
                    @enderror
                    <p class="">
                        {!! str($this->product->short_description)->markdown() !!}
                    </p>
                    <div class="pro-details-social-info">
                        <div class="pro-details-wish-com">
                            <div class="pro-details-wishlist">
                                <a href="javascript:;">
                                    <i class="ion-android-favorite-outline"></i>
                                    Add to wishlist
                                </a>
                                @if ($this->product->ar_image)
                                    <model-viewer id="ARviewer"
                                        src="{{ asset('storage/' . $this->product->ar_image) }}"
                                        ios-src="{{ asset('storage/' . $this->product->ar_image_ios) }}"
                                        alt="A 3D model of a furniture item" ar ar-placement="floor" ar-scale="fixed"
                                        ar-modes="webxr" camera-controls disable-pan disable-tap disable-zoom
                                        auto-rotate reveal="interaction" shadow-intensity="2" shadow-softness="1"
                                        max-camera-orbit="auto 90deg auto" touch-action="pan-y" exposure="1"
                                        tone-mapping="aces" environment-image="neutral" xr-environment slot="canvas">

                                        <button class="border-0 p-0 bg-transparent" slot="ar-button" id="ar-button">
                                            <i class="ion-android-favorite-outline"></i>
                                            View in your space
                                        </button>

                                        <div id="ar-failure"></div>
                                        <div id="ar-status-message"></div>
                                        <div id="dimension-label">Width: 10cm | Height: 40cm | Depth: 30cm</div>
                                    </model-viewer>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="pro-details-policy">
                        <ul>
                            <li>
                                <img src="{{ asset('sites/images/icons/policy.webp') }}" alt="policy" />
                                <span>
                                    100% Authenticity Guaranteed
                                </span>
                            </li>
                            <li>
                                <img src="{{ asset('sites/images/icons/policy-2.webp') }}" alt="policy-2" />
                                <span>
                                    Free Shipping on Orders Over ₱1,000
                                </span>
                            </li>
                            <li>
                                <img src="{{ asset('sites/images/icons/policy-3.webp') }}" alt="policy-3" />
                                <span>
                                    30-Day Easy Returns
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-shop.section>

    {{-- Descriptions --}}
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details2">Product Details</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews
                        ({{ $this->productFeedbacks->avg('rating') }})</a>
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
                                @forelse ($this->productFeedbacks as $feedback)
                                    <x-shop.review-card :feedback="$feedback" />
                                @empty
                                    - No Reviews Available -
                                @endforelse
                            </div>
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
                data-aos-delay="200" wire:ignore>
                <div class="new-product-wrapper swiper-wrapper">
                    @forelse ($this->productRecommendations as $product_recommendation)
                        <div class="new-product-item swiper-slide"
                            wire:key="product-recommendation-{{ $product_recommendation->id }}">
                            <x-shop.product-card :product="$product_recommendation" />
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
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js" defer></script>
    <style src="{{ asset('css/model-viewer.css') }}"></style>
@endassets


@script
    <script type="module" defer>
        const viewer = document.querySelector("#ARviewer");
        const arStatusMessage = document.querySelector("#ar-status-message");
        const dimensionLabel = document.querySelector("#dimension-label");

        viewer.addEventListener("ar-tracking", (event) => {
            if (event.detail.status === "not-tracking") {
                arStatusMessage.textContent = "Searching for a surface...";
                arStatusMessage.style.display = "block";
                dimensionLabel.style.display = "none";
            } else {
                arStatusMessage.style.display = "none";
                dimensionLabel.style.display = "block";
            }
        });

        viewer.addEventListener("ar-status", (event) => {
            const status = event.detail.status;

            switch (status) {
                case "not-presenting":
                    arStatusMessage.textContent = "AR session ended.";
                    dimensionLabel.style.display = "none";
                    break;
                case "session-started":
                    arStatusMessage.innerHTML = `
                        <div id="calibration-animation">📱</div>
                        Move your device slowly to detect a surface.<br>
                        Ensure good lighting and a flat surface.
                    `;
                    arStatusMessage.style.display = "block";
                    break;
                case "object-placed":
                    arStatusMessage.style.display = "none";
                    dimensionLabel.style.display = "block";
                    break;
                case "failed":
                    alert("AR session failed. Please try again.");
                    dimensionLabel.style.display = "none";
                    break;
                default:
                    arStatusMessage.textContent = "Unknown AR status.";
                    break;
            }
        });
    </script>
@endscript
