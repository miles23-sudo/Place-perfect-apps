<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductVariant;
use App\Models\ProductCategory;
use App\Models\OrderItem;
use App\Models\Feedback;
use App\Models\Cart;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    const CURRENCY = 'PHP';

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
        return !empty($this->ar_image) || !empty($this->ar_image_ios);
    }

    // Get the price with currency symbol
    public function getPriceWithCurrencySymbolAttribute(): string
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, self::CURRENCY);
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

    // Helpers

    // has AR Image
    public function HasArImage(): bool
    {
        return filled($this->ar_image) && filled($this->ar_image_ios);
    }

    // Is New
    public function isNew(): bool
    {
        return now()->diffInDays($this->created_at) <= 30;
    }
}
