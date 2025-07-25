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

    #[Validate('required|email|exists:customers,email')]
    public $email;

    #[Validate('required')]
    public $password;

    #[Validate('required|boolean')]
    public $remember;

    public function submit()
    {
        $this->validate();

        try {
            $this->rateLimit(5);

            if (auth('customer')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                return $this->redirectIntended(route('customer.profile'));
            }

            session()->flash('message', 'Login failed! Please check your credentials.');
        } catch (TooManyRequestsException $e) {
            session()->flash('message', "Slow down! Try again in {$e->secondsUntilAvailable} seconds.");
        }
    }


    public function render()
    {
        return view('livewire.auth.customer-login');
    }
}
