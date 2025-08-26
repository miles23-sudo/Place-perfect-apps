<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Settings\Shop;
use App\Models\Product;
use App\Models\Customer;

class Cart extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
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

    // Get the total with currency symbol
    public function getTotalWithCurrencySymbolAttribute(): string
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->total, Product::CURRENCY);
    }
}
