<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:6')]
    public $password;

    #[Validate('boolean')]
    public $remember_me = false;

    public function login()
    {
        $this->validate();

        if (auth('customer')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $this->redirectIntended(route('customer.account'));
        }

        $this->addError('email', 'Invalid email or password.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
