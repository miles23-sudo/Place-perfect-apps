<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        auth('customer')->logout();

        $this->redirect(route('auth.login'));
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
