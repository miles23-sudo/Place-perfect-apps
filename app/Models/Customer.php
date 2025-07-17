<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Feedback;
use Jaydoesphp\PSGCphp\PSGC;

class Customer extends Model
{
    protected $guarded = ['id'];

    // Relationships

    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
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
