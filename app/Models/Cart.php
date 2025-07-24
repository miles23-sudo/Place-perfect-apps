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
}
