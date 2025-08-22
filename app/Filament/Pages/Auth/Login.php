<?php

namespace App\Filament\Pages\Auth;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;

class Login extends BaseLogin
{
    use HasCustomLayout;

    public function mount(): void
    {
        parent::mount();

        if (app()->environment('local')) {
            $this->form->fill([
                'email' => 'admin@admin.com',
                'password' => 'password',
                'remember' => true,
            ]);
        }
    }

    public function getHeading(): Htmlable
    {
        return new HtmlString('
            <div class="text-2xl font-bold">Welcome Back!</div>
            <div class="mb-3 text-sm text-gray-500 dark:text-gray-300">Please log in to your account.</div>
            ' . Blade::render(<<<BLADE
             <x-filament::link :href="route('home')">
                Go back
            </x-filament::link>
            BLADE) . '');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent()
                    ->revealable(false),
                $this->getRememberFormComponent(),
            ]);
    }
}
