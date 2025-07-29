<?php

namespace App\Filament\Customer\Pages\Auth;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;

class Login extends BaseLogin
{
    use HasCustomLayout;

    public function getHeading(): Htmlable
    {
        return new HtmlString('
            <div class="text-2xl font-bold">Welcome Back!</div>
            <div class="text-sm text-gray-500 mb-3">
                Enjoy the best experience with Place Perfect.
            </div>
            ' . Blade::render(<<<BLADE
             <x-filament::link icon="ri-arrow-left-long-fill" :href="route('home')">
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
