<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\Customer;

class Feedback extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackFactory> */
    use HasFactory;

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
}
