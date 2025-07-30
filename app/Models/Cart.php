<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Settings\Shop;
use App\Models\Product;
use App\Models\Customer;

class Cart extends Model
{
    protected $guarded = ['id'];

    public $formatter;

    const CURRENCY = 'PHP';

    public function __construct()
    {
        $this->formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'product_snapshot' => 'array',
        ];
    }

    // Relationships

    // Customer relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Product relationship
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Getters

    // Get the price with currency symbol
    public function getPriceWithCurrencySymbolAttribute(): string
    {
        return $this->formatter->formatCurrency($this->price, self::CURRENCY);
    }

    // Get the total with currency symbol
    public function getTotalWithCurrencySymbolAttribute(): string
    {
        return $this->formatter->formatCurrency($this->total, self::CURRENCY);
    }

    // Helpers

    // Get the total price of the cart items


    // Create or update cart item
    public static function addOrUpdate($productId, $quantity = 1)
    {
        if (!auth()->check()) {
            return self::updateOrCreate(
                ['session_id' => session()->getId(), 'product_id' => $productId],
                ['quantity' => $quantity]
            );
        }

        return self::updateOrCreate(
            ['customer_id' => auth('customer')->id(), 'product_id' => $productId],
            ['quantity' => $quantity]
        );
    }

    // Boot
    protected static function boot()
    {
        parent::boot();

        // Every create set product_name and price
        static::creating(function ($cart) {
            if ($cart->product) {
                $cart->product_snapshot = $cart->product->toArray();
                $cart->price = $cart->product->price;
            }
        });
    }
}
