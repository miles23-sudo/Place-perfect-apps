<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Customer;

class Feedback extends Model
{
    protected $guarded = ['id'];

    // Relationships

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Helper Methods

    // hasResponse
    public function hasResponse()
    {
        return $this->response;
    }
}
