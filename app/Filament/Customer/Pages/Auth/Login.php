<?php

namespace App\Filament\Customer\Pages\Auth;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Models\Contracts\FilamentUser;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Forms\Form;
use Filament\Facades\Filament;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use App\Models\Cart;

class Login extends BaseLogin
{
    use HasCustomLayout;

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $old_session = session()->getId(); // Store the old session ID before it gets regenerated

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (($user instanceof FilamentUser) && (! $user->canAccessPanel(Filament::getCurrentPanel()))) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        $this->getSessionCartItemUpdate($old_session);

        return app(LoginResponse::class);
    }

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

    // get cart item update or create based on the session or customer ID
    public function getSessionCartItemUpdate($old_session)
    {

        return Cart::where('session_id', $old_session)
            ->whereNull('customer_id')
            ->update([
                'customer_id' => auth('customer')->id(),
            ]);
    }
}
