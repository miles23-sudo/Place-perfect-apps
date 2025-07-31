<?php

namespace App\Filament\Customer\Clusters\Dashboard\Pages;

use App\Filament\Customer\Clusters\Dashboard;
use Filament\Pages\Page;
use Filament\Notifications;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms;
use App\Rules\EmailUniqueAcrossTablesRule;

class MyAccount extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'ri-user-3-line';

    protected static string $view = 'filament.customer.clusters.dashboard.pages.my-account';

    protected static ?string $cluster = Dashboard::class;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth('customer')->user()->only(['avatar', 'name', 'email', 'phone_number']));
    }

    public function form(Forms\Form $form): Forms\Form
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
            ->statePath('data');
    }

    public function create(): void
    {
        auth('customer')->user()->update($this->form->getState());

        Notifications\Notification::make()
            ->title('Profile Updated')
            ->success()
            ->send();
    }
}
