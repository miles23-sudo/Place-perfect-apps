<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Panel;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\FilamentUser;
use Arxjei\PSGC;
use App\Models\User;
use App\Models\Order;
use App\Models\Feedback;
use App\Models\CustomerAddress;
use App\Livewire\Cart;

class Customer extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationships

    // Customer Address Has One
    public function customerAddress()
    {
        return $this->hasOne(CustomerAddress::class);
    }

    // Cart
    public function cart()
    {
        return $this->hasMany(Cart::class);
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

    // FilamentHelpers

    // Get Avatar URL
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar ?
            asset('storage/' . $this->avatar) :
            'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=EAB308&color=fff';
    }

    // Can Access Panel
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
