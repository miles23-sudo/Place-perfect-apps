<?php

namespace App\Filament\Customer\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Facades\Filament;
use Filament\Events\Auth\Registered;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use App\Models\Cart;

class Register extends BaseRegister
{
    use HasCustomLayout;

    public function mount(): void
    {
        parent::mount();
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function () {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');

            $user = $this->handleRegistration($data);

            $this->form->model($user)->saveRelationships();

            $this->callHook('afterRegister');

            return $user;
        });

        $old_session = session()->getId();

        event(new Registered($user));

        $this->sendEmailVerificationNotification($user);

        Filament::auth()->login($user);

        session()->regenerate();

        $this->getSessionCartItemUpdate($old_session);

        return app(RegistrationResponse::class);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getPhoneNumberFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    // Add Phone Number Form Component
    protected function getPhoneNumberFormComponent(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('phone_number')
            ->tel()
            ->required()
            ->startsWith('+639')
            ->maxLength(13)
            ->default('+639');
    }

    // get cart item update or create based on the session or customer ID
    public function getSessionCartItemUpdate($old_session)
    {

        return Cart::whereSessionId($old_session)
            ->whereNull('customer_id')
            ->update([
                'customer_id' => auth('customer')->id(),
            ]);
    }
}
