<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use App\Models\User;

class CustomerRegister extends Component
{
    use WithRateLimiting;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|unique:users,email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    #[Validate('required|min:8|same:password')]
    public $password_confirmation;

    public function submit()
    {
        $this->validate();

        try {
            $this->rateLimit(1, decaySeconds: 180); // Rate limit to 1 request every 3 minutes

            User::create($this->pull());

            session()->flash('message', 'Registration successful! You can now log in.');
        } catch (TooManyRequestsException $e) {
            session()->flash('message', "Slow down! Try again in {$e->secondsUntilAvailable} minutes.");
        }
    }

    public function render()
    {
        return view('livewire.auth.customer-register');
    }
}
