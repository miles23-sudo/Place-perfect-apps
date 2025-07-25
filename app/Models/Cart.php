<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Customer;

class Cart extends Model
{
    protected $guarded = ['id'];

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

    // Helpers

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
            ['user_id' => auth()->id(), 'product_id' => $productId],
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
                $cart->product_name = $cart->product->name;
                $cart->price = $cart->product->price;
            }
        });
    }
}
