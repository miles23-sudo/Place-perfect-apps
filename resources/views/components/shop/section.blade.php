@props([
    'title' => 'Categories',
    'subtitle' => null,
])

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row breadcrumb_box align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                        <h2 class="breadcrumb-title">{{ $title }}</h2>
                        @if ($subtitle)
                            <p class="desc">{!! $subtitle !!}</p>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <ul class="breadcrumb-list text-center text-md-end" aria-label="Breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item">{{ $title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Body --}}
<div {{ $attributes->merge(['class' => 'pb-100px pt-100px']) }}>
    <div class="container">
        {{ $slot }}
    </div>
</div>
