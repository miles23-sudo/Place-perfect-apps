<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rules\Password;
use App\Models\Customer;

class ResetPassword extends Component
{
    #[Locked]
    public $email;

    public $new_password, $confirm_password;

    public function mount()
    {
        if (Customer::whereEmail($this->email)->where('updated_at', '>=', now()->subMinutes(30))->exists()) {
            $this->redirect(route('auth.login'));
        }
    }

    public function rules()
    {
        return [
            'new_password' => ['required', Password::min(8)->uncompromised()],
            'confirm_password' => ['required', 'same:new_password'],
        ];
    }

    public function resetPassword()
    {
        $this->validate();

        Customer::whereEmail($this->email)->update([
            'password' => bcrypt($this->new_password),
        ]);

        $this->redirect(route('auth.login'));

        notyf('Password reset successfully');
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
