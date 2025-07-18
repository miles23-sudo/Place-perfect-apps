<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use App\Models\Customer;
use App\Enums\UserRole;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    // Relationships

    // Customers
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    // Custom Methods

    // Is Customer
    public function isCustomer(): bool
    {
        return $this->role === UserRole::Customer;
    }

    // Filament User
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === UserRole::Admin;
    }

    // Boot 
    protected static function booted()
    {
        static::created(function ($user) {
            if ($user->role === UserRole::Customer) {
                $user->customers()->create([]);
            }
        });
    }
}
