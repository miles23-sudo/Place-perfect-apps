<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\CustomerAddress;
use App\Models\Customer;
use App\Enums\OrderStatus;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
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
            'paid_at' => 'datetime',
            'created_at' => 'datetime',
            'status' => OrderStatus::class,
        ];
    }

    // Relationship

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Customer address
    public function customerAddress()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    // Order items relationship
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes

    // status is to pay
    public function scopeToPay($query)
    {
        return $query->where('status', OrderStatus::ToPay);
    }

    // Get the overall total with currency symbol
    public function getOverallTotalWithCurrencySymbolAttribute(): string
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->overall_total, Product::CURRENCY);
    }

    // Helper

    // is Order To Retry Payment
    public function isToRetryPayment(): bool
    {
        return $this->status === OrderStatus::ToRetryPayment;
    }
}
