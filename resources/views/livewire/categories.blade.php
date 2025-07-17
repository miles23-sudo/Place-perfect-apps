<div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row breadcrumb_box  align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                            <h2 class="breadcrumb-title">Categories</h2>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <ul class="breadcrumb-list text-center text-md-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item">Categories</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Category --}}
    <div class="section pb-100px pt-100px">
        <div class="container">
            <div class="row">
                @forelse ($this->productCategories as $category)
                    <div class="col-lg-4 col-12 my-2" data-aos="fade-up" data-aos-delay="{{ 200 + $loop->index * 200 }}"
                        wire:key="product-category-{{ $category->id }}">
                        <div class="banner-2">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="" />
                            <div class="info justify-content-start">
                                <div class="content align-self-center">
                                    <h3 class="title">
                                        {{ $category->name }}
                                    </h3>
                                    <a href="{{ route('shop') . '?category=' . $category->slug }}" class="shop-link">
                                        View Products
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        - No Categories Available -
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
