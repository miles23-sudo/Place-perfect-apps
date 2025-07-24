@props(['feedback'])

<div class="review-wrapper mb-5" {{ $attributes }}>
    <div class="single-review mb-3" wire:key="product-feedback-{{ $feedback->id }}">
        <div class="review-img">
            @if ($feedback->customer && $feedback->customer->avatar)
                <img src="{{ asset('storage/' . $feedback->customer->avatar) }}"
                    alt="{{ $feedback->customer->name ?? 'Anonymous' }}" />
            @else
                <img src="{{ asset('sites/images/user/default.png') }}" class="img-fluid" alt="Anonymous" />
            @endif
        </div>

        <div class="review-content">
            <div class="review-top-wrap">
                <div class="review-left">
                    <div class="review-name">
                        <h4>{{ $feedback->customer->name ?? 'Anonymous' }}</h4>
                    </div>
                    <div class="rating-product">
                        {!! $feedback->product->renderStars() !!}
                    </div>
                </div>
            </div>

            <div class="review-bottom">
                <p>{{ $feedback->comment ?? 'No comment provided.' }}</p>
            </div>
        </div>
    </div>

    @if ($feedback->hasResponse())
        <div class="single-review child-review">
            <div class="review-img">
                <img src="{{ asset('sites/images/logo/logo.png') }}" alt="Seller" />
            </div>

            <div class="review-content">
                <div class="review-top-wrap">
                    <div class="review-left">
                        <div class="review-name">
                            <h4>Seller Response</h4>
                        </div>
                    </div>
                </div>
                <div class="review-bottom">
                    <p>{!! str($feedback->response)->markdown() !!}</p>
                </div>
            </div>
        </div>
    @endif
</div>
