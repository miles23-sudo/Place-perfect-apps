<?php

namespace App\Models;

use Arxjei\PSGC;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class CustomerAddress extends Model
{
    protected $guarded = ['id'];

    // Relationships

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Getters

    // Region name
    public function getRegionNameAttribute()
    {
        return $this->region ? PSGC::getRegionsByCode($this->region)['region_name'] : null;
    }

    // Province name
    public function getProvinceNameAttribute()
    {
        return $this->province ? PSGC::getProvincesByCode($this->province)['province_name'] : null;
    }

    // City name
    public function getCityNameAttribute()
    {
        return $this->city ? PSGC::getCitiesByCode($this->city)['city_name'] : null;
    }

    // Barangay name
    public function getBarangayNameAttribute()
    {
        return $this->barangay ? PSGC::getBarangaysByCode($this->barangay)['barangay_name'] : null;
    }
}
