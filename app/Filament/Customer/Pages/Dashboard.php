<?php

namespace App\Filament\Customer\Pages;

use App\Models\CustomerAddress;
use Filament\Pages\Dashboard as BasePage;
use Filament\Notifications;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms;
use Cheesegrits\FilamentGoogleMaps;
use App\Rules\EmailUniqueAcrossTablesRule;
use App\Rules\AcrossValenzuelaOnly;

class Dashboard extends BasePage implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'phosphor-user-duotone';

    protected static ?string $navigationLabel = "My Profile";

    protected ?string $heading = 'My Profile';

    protected static string $view = 'filament.customer.pages.dashboard';

    public ?array $profileData = [];

    public ?array $profileAddressData = [];

    public function mount(): void
    {
        $this->editProfileForm->fill(auth('customer')->user()->only(['name', 'email', 'phone_number']));
        $this->editProfileAddressForm->fill(auth('customer')->user()->customerAddress?->toArray());
    }

    protected function getForms(): array
    {
        return [
            'editProfileForm',
            'editProfileAddressForm',
        ];
    }

    public function editProfileForm(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar')
                    ->lazy()
                    ->image()
                    ->imageCropAspectRatio('1:1')
                    ->directory('avatars'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->startsWith('+639')
                    ->length(13),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->rule(fn() => new EmailUniqueAcrossTablesRule(auth('customer')->user()))
                    ->maxLength(255),
            ])
            ->statePath('profileData');
    }

    public function editProfileAddressForm(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->live()
                    ->maxLength(255)
                    ->rule(new AcrossValenzuelaOnly()),
                FilamentGoogleMaps\Fields\Map::make('location')
                    ->hint('Accept Permissions to use location services')
                    ->required()
                    ->live()
                    ->mapControls([
                        'mapTypeControl'    => true,
                        'scaleControl'      => true,
                        'streetViewControl' => true,
                        'rotateControl'     => true,
                        'fullscreenControl' => true,
                        'searchBoxControl'  => false,
                        'zoomControl'       => false,
                    ])
                    ->defaultZoom(18)
                    ->reverseGeocode([
                        'address' => '%n %S, %L, %A1, %z, %C',
                    ])
                    ->defaultLocation([14.69292810676326, 120.96940195544433])
                    ->geolocate()
                    ->geolocateOnLoad()
                    ->draggable()
                    ->clickable(false)
                    ->lazy()
            ])
            ->statePath('profileAddressData');
    }

    public function updateProfile(): void
    {
        auth('customer')->user()->update($this->editProfileForm->getState());

        Notifications\Notification::make()
            ->title('Profile Updated')
            ->success()
            ->send();
    }

    public function updateProfileAddress(): void
    {
        CustomerAddress::updateOrCreate(
            ['customer_id' => auth('customer')->id()],
            $this->editProfileAddressForm->getState()
        );

        Notifications\Notification::make()
            ->title('Address Updated')
            ->success()
            ->send();
    }
}
