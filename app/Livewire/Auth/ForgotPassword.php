<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\Auth\PasswordResetMail;

class ForgotPassword extends Component
{
    #[Validate('required|email|exists:customers,email')]
    public $email;

    public function sendResetLink()
    {
        $this->validate();

        $temp_url = URL::temporarySignedRoute(
            'auth.reset-password',
            now()->addMinutes(30),
            ['email' => $this->email]
        );

        // Send password reset link logic here
        Mail::to($this->email)->send(new PasswordResetMail($temp_url));

        $this->reset();

        notyf('Password reset link sent successfully!');
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
