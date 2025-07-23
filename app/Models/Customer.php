<?php

namespace App\Models;

use Arxjei\PSGC;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use App\Models\User;
use App\Models\Order;
use App\Models\Feedback;
use App\Models\CustomerAddress;

class Customer extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $guarded = ['id'];

    // Relationships

    // Customer Address Has One
    public function customerAddress()
    {
        return $this->hasOne(CustomerAddress::class);
    }

    // Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }



    // Filament User
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
