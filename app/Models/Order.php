<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CustomerAddress;
use App\Models\Customer;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $guarded = ['id'];

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

    // Custom Method

    // Generate a unique order number
    public function generateOrderNumber()
    {
        while (true) {
            $orderNumber = (string) str()->uuid();
            if (!self::where('order_number', $orderNumber)->exists()) {
                return $orderNumber;
            }
        }
    }

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = $order->generateOrderNumber();
            }
        });
    }
}
