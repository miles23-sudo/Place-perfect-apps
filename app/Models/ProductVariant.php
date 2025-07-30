<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductVariant extends Model
{
    protected $guarded = ['id'];

    // Relationships

    // Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
