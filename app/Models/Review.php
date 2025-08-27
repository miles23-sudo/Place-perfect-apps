<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;

class Review extends Model
{
    protected $guarded = ['id'];

    // Relationships

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
