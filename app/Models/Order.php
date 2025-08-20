<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Customer;
use App\Enums\PaymentMode;
use App\Enums\OrderStatus;

class Order extends Model
{
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

    // Order items relationship
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes

    // status is to pay
    public function scopeToPay($query)
    {
        return $query->whereStatus(OrderStatus::ToPay);
    }

    // status is to retry payment
    public function scopeToRetryPayment($query)
    {
        return $query->whereStatus(OrderStatus::ToRetryPayment);
    }

    // status is to ship
    public function scopeToShip($query)
    {
        return $query->whereStatus(OrderStatus::ToShip);
    }

    // status is to receive
    public function scopeToReceive($query)
    {
        return $query->whereStatus(OrderStatus::ToReceive);
    }

    // status is completed
    public function scopeCompleted($query)
    {
        return $query->whereStatus(OrderStatus::Completed);
    }

    // status is to return/refund
    public function scopeReturnRefund($query)
    {
        return $query->whereStatus(OrderStatus::ReturnRefund);
    }

    // status is to cancel
    public function scopeCancelled($query)
    {
        return $query->whereStatus(OrderStatus::Cancelled);
    }

    // Get the overall total with currency symbol
    public function getOverallTotalWithCurrencySymbolAttribute(): string
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->overall_total, Product::CURRENCY);
    }

    // Get the total revenue with currency symbol
    public function getTotalRevenueWithCurrencySymbolAttribute(): string
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->items->sum('overall_total'), Product::CURRENCY);
    }

    // Helper

    // is To Pay
    public function isToPay(): bool
    {
        return $this->status === OrderStatus::ToPay;
    }

    // is Order To Retry Payment
    public function isToRetryPayment(): bool
    {
        return $this->status === OrderStatus::ToRetryPayment;
    }

    // to ship
    public function isToShip(): bool
    {
        return $this->status === OrderStatus::ToShip;
    }

    // is Ready to Receive
    public function isToReceive(): bool
    {
        return $this->status === OrderStatus::ToReceive;
    }

    // isCod
    public function isCOD(): bool
    {
        return $this->payment_method === PaymentMode::COD->value;
    }

    // Boot

    public static function boot()
    {
        parent::boot();

        // Automatically set the status to ToPay when creating a new order
        static::creating(function ($order) {
            $order->order_number = uniqid('order_');
        });
    }
}
