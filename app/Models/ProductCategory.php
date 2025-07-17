<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scopes

    // is Active
    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    // Getters

    // images
    public function getImagesAttribute($value)
    {
        return $value ?? [];
    }
}
