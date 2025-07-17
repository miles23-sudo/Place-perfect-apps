<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use App\Models\User;

class CustomerLogin extends Component
{
    use WithRateLimiting;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    #[Validate('required|boolean')]
    public $remember;

    public function submit()
    {
        $this->validate();

        try {
            $this->rateLimit(5);

            if (User::where('email', $this->email)->exists()) {
                if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                    return $this->redirectIntended(route('home'));
                }

                return $this->addError('email', 'Invalid credentials.');
            }

            $this->addError('email', 'No account found with that email.');
        } catch (TooManyRequestsException $e) {
            $this->addError('email', "Slow down! Try again in {$e->secondsUntilAvailable} seconds.");
        }
    }


    public function render()
    {
        return view('livewire.auth.customer-login');
    }
}
