<?php

namespace App\Models;

use Jaydoesphp\PSGCphp\PSGC;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use App\Models\User;
use App\Models\Feedback;

class Customer extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;
    protected $guarded = ['id'];

    // Relationships

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

    // Helpers

    // Filament User
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
