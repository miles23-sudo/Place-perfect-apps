<div>
    <x-shop.section class="section">
        <div class="row">
            @forelse ($this->productCategories as $category)
                <div class="col-lg-4 col-12 my-2" data-aos="fade-up" data-aos-delay="{{ 200 + $loop->index * 200 }}"
                    wire:key="product-category-{{ $category->id }}">
                    <x-shop.category-card :category="$category" class="mb-4" />
                </div>
            @empty
                - No Categories Available -
            @endforelse
        </div>

        {{ $this->productCategories->links(data: ['scrollTo' => false]) }}
    </x-shop.section>
</div>
