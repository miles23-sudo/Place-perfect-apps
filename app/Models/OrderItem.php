<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;

class OrderItem extends Model
{
    protected $guarded = ['id'];

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
