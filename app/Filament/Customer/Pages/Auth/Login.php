<?php

namespace App\Filament\Customer\Pages\Auth;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Pages\Auth\Login as BaseLogin;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;

class Login extends BaseLogin
{
    use HasCustomLayout;

    public function getHeading(): Htmlable
    {
        return new HtmlString('
            <div class="text-2xl font-bold dark:text-white">
                Welcome Back!
            </div>
            <div class="mb-3 text-sm text-gray-500">
                Enjoy the best experience with Place Perfect.
            </div>
            ' . Blade::render(<<<BLADE
             <x-filament::link :href="route('home')">
                Shop Now!
            </x-filament::link>
            BLADE) . '');
    }
}
