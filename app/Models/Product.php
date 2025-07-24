<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductCategory;
use App\Models\OrderItem;
use App\Models\Feedback;
use App\Models\Cart;

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

    // Cart
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    // Feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Getters

    // has AR Image
    public function getHasArImageAttribute(): bool
    {
        return !empty($this->ar_image);
    }

    // Scopes

    // is Active
    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    // Sort ascending by name
    public function scopeSortByNameAsc($query, $direction = 'asc')
    {
        return $query->orderBy('name', $direction);
    }

    // sort by price
    public function scopeSortByPrice($query, $direction = 'asc')
    {
        return $query->orderBy('price', $direction);
    }

    // Helper Methods

    // renderStars
    public function renderStars(): string
    {
        $stars = '';
        $averageRating = $this->feedbacks()->avg('rating');
        $fullStars = floor($averageRating);
        $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;

        for ($i = 0; $i < $fullStars; $i++) {
            $stars .= '<i class="ion-android-star"></i>';
        }

        if ($halfStar) {
            $stars .= '<i class="ion-android-star-half"></i>';
        }

        for ($i = 0; $i < $emptyStars; $i++) {
            $stars .= '<i class="ion-android-star-outline"></i>';
        }

        return $stars;
    }
}
