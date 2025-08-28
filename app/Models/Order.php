<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\OrderObserver;
use App\Models\Review;
use App\Models\Product;
use App\Models\Customer;
use App\Enums\OrderStatus;
use App\Enums\OrderPaymentMode;

#[ObservedBy(OrderObserver::class)]
class Order extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected $appends = [
        'status_activity',
        'payment_to_collect'
    ];

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
            'payment_mode' => OrderPaymentMode::class,
            'status' => OrderStatus::class,
            'return_photos' => 'array',
        ];
    }

    // Relationship

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Review relationship
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Order items relationship
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Getters

    // Get the status activity attribute
    public function getStatusActivityAttribute(): array
    {
        return collect(OrderStatus::cases())
            ->map(function ($status) {
                $dateField = str($status->value . '_at')->snake()->value;
                $dateValue = $this->{$dateField} ?? null;

                return $dateValue ? [
                    'title' => $status->getLabel(),
                    'description' => $status->getDescription(),
                    'status' => $status,
                    'created_at' => $dateValue,
                ] : null;
            })
            ->filter()
            ->values()
            ->toArray();
    }

    // Get the payment to collect attribute
    public function getPaymentToCollectAttribute(): float
    {
        if ($this->isCod() || $this->isCash()) {
            return $this->overall_total ?? 0.0;
        }

        return 0.0;
    }

    // Scopes

    // status is to pay
    public function scopeToPay($query)
    {
        return $query->whereStatus(OrderStatus::ToPay);
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

    // status is delivered
    public function scopeDelivered($query)
    {
        return $query->whereStatus(OrderStatus::Delivered);
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

    // scope for consider as income
    public function scopeIsConsiderAsIncome($query)
    {
        return $query->whereIn('status', [
            OrderStatus::ToShip,
            OrderStatus::Delivered,
            OrderStatus::ReturnRefund,
            OrderStatus::ReturnRefundCompleted,
            OrderStatus::ReturnRefundDeclined,
        ]);
    }

    // Helper

    // is To Pay
    public function isToPay(): bool
    {
        return $this->status === OrderStatus::ToPay;
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

    public function isDelivered(): bool
    {
        return $this->status === OrderStatus::Delivered;
    }

    public function isReturnRefund(): bool
    {
        return $this->status === OrderStatus::ReturnRefund;
    }

    // is cod
    public function isCod(): bool
    {
        return $this->payment_mode === OrderPaymentMode::COD;
    }

    public function isCash(): bool
    {
        return $this->payment_mode === OrderPaymentMode::Cash;
    }

    public function isCancellable(): bool
    {
        return $this->isToPay() && $this->isCod();
    }

    public function isReturnRefundable(): bool
    {
        return $this->isDelivered() && $this->reviews()->count() == 0;
    }

    public function isInReturnRefund(): bool
    {
        return in_array($this->status, [
            OrderStatus::ReturnRefund,
            OrderStatus::ReturnRefundCompleted,
            OrderStatus::ReturnRefundDeclined,
        ]);
    }

    public function isStatusNotifiable(): bool
    {
        return in_array($this->status, [
            OrderStatus::Delivered,
            OrderStatus::ReturnRefund,
            OrderStatus::Cancelled,
            OrderStatus::ReturnRefund,
        ]);
    }

    public function isOnlinePayment(): bool
    {
        return $this->payment_mode == OrderPaymentMode::Online;
    }
}
