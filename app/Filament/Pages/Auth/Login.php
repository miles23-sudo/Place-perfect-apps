<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\ViewField;
use Filament\Pages\Auth\Login as BaseLogin;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Filament\Forms\Form;

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

    public function getHeading(): string
    {
        return "Login to Admin Panel";
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getGoBackActionFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent()
                    ->revealable(false),
            ]);
    }

    public function getGoBackActionFormComponent(): ViewField
    {
        return ViewField::make('goBack')
            ->view('filament.pages.auth.gobackactionform');
    }
}
