<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductCategory;
use App\Models\Feedback;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'images' => 'array',
            'features' => 'array',
        ];
    }

    // Relationships

    // Product Category
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    // Feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
