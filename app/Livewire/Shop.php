<?php

namespace App\Livewire;

use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;
use Livewire\Attributes\Session;
use Livewire\Attributes\Computed;
use App\Models\ProductCategory;
use App\Models\Product;

class Shop extends Component
{
    use WithPagination, WithoutUrlPagination;

    // protected $paginationTheme = 'bootstrap';

    #[Url(as: 'category', history: true)]
    public ?string $selected_category = null;

    #[Session]
    #[Validate('in:asc,desc,price_asc,price_desc')]
    public $sort = 'asc';

    public function updatedSort($property, $value)
    {
        $this->{$property} = $value;
    }

    #[Computed]
    public function productCategories()
    {
        return ProductCategory::isActive()
            ->withCount(['products as products_count' => function ($query) {
                $query->isActive();
            }])
            ->with(['products' => fn($query) => $query->isActive()])
            ->get();
    }

    #[Computed]
    public function totalProducts()
    {
        return Product::isActive()->count();
    }

    #[Computed]
    public function selectedCategory()
    {
        return ProductCategory::isActive()
            ->whereSlug($this->selected_category)
            ->first();
    }

    #[Computed]
    public function products()
    {
        return Product::isActive()
            ->when($this->selected_category, function ($query) {
                return $query->with('productCategory')
                    ->whereHas('productCategory', function ($q) {
                        $q->where('slug', $this->selected_category);
                    });
            })
            ->when($this->sort, fn($q) => $q->orderBy(
                str_contains($this->sort, 'price') ? 'price' : 'name',
                str_ends_with($this->sort, 'desc') ? 'desc' : 'asc'
            ))
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.shop');
    }
}
