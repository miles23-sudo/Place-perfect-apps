<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Feedback;

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
}
