<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Resource;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use Cheesegrits\FilamentGoogleMaps;
use App\Rules\EmailUniqueAcrossTablesRule;
use App\Rules\AcrossValenzuelaOnly;
use App\Models\Customer;
use App\Filament\Resources\CustomerResource\Pages;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'phosphor-shopping-bag-duotone';

    protected static ?string $navigationGroup = 'Customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->startsWith('+639')
                    ->length(13),
                Forms\Components\TextInput::make('email')
                    ->hintIcon('phosphor-info-duotone')
                    ->hintIconTooltip('Upon account creation, an email containing the account details will be sent to the provided address.')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->rule(fn($record) => new EmailUniqueAcrossTablesRule($record))
                    ->maxLength(255),
                Forms\Components\Fieldset::make('Shipping Address')
                    ->relationship('customerAddress')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->live()
                            ->maxLength(255)
                            ->rule(new AcrossValenzuelaOnly()),
                        FilamentGoogleMaps\Fields\Map::make('location')
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
                            ->defaultZoom(15)
                            ->reverseGeocode([
                                'address' => '%n %S, %L, %A1, %z, %C',
                            ])
                            ->debug()
                            ->geolocate()
                            ->geolocateOnLoad()
                            ->draggable()
                            ->clickable(false)
                            ->lazy()
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Access')
                    ->onIcon('phosphor-check-circle-duotone')
                    ->offIcon('phosphor-x-circle-duotone'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ActionGroup::make([
                    self::getEditAction(),
                    self::getPasswordResetAction(),
                ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/')
        ];
    }

    // Actions

    // Edit Action
    public static function getEditAction(): Tables\Actions\EditAction
    {
        return Tables\Actions\EditAction::make()
            ->successNotificationMessage(fn($record) => "The customer '{$record->name}' has been updated.")
            ->modalWidth(MaxWidth::FourExtraLarge)
            ->closeModalByClickingAway(false);
    }

    // Reset Password Action
    public static function getPasswordResetAction(): Tables\Actions\Action
    {
        $raw_password = Str::random(10);

        return Tables\Actions\Action::make('resetPassword')
            ->icon('phosphor-lock-duotone')
            ->requiresConfirmation()
            ->action(function ($record) use ($raw_password) {
                $record->update(['password' => bcrypt($raw_password)]);
            })
            ->after(function ($record) use ($raw_password) {
                // TODO: Send email to the customer with the raw password
                // Mail::to($record->email)->send(new CustomerResetPassword($record, $raw_password));
            });
    }
}
