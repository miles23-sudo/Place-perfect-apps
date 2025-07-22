<?php

namespace App\Filament\Resources;

use Jaydoesphp\PSGCphp\PSGC;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Infolists;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use App\Rules\EmailUniqueAcrossTablesRule;
use App\Models\CustomerAddress;
use App\Models\Customer;
use App\Filament\Resources\CustomerResource\Pages;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'ri-shopping-bag-line';

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
                    ->startsWith('09')
                    ->length(11),
                Forms\Components\TextInput::make('email')
                    ->hintIcon('ri-information-line')
                    ->hintIconTooltip('Upon account creation, an email containing the account details will be sent to the provided address.')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->rule(fn($record) => new EmailUniqueAcrossTablesRule($record))
                    ->maxLength(255),
                Forms\Components\Fieldset::make('Shipping Address')
                    ->relationship('customerAddress')
                    ->schema([
                        Forms\Components\TextInput::make('house_number')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('street')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('region')
                            ->required()
                            ->reactive()
                            ->options(collect(PSGC::getRegions())->pluck('region_name', 'region_code'))
                            ->afterStateUpdated(function ($set) {
                                $set('province', null);
                                $set('city', null);
                                $set('barangay', null);
                            }),
                        Forms\Components\Select::make('province')
                            ->required()
                            ->reactive()
                            ->options(function (Get $get) {
                                if (filled($get('region'))) {
                                    return collect(PSGC::getAllProvincesByRegionCode($get('region')))
                                        ->pluck('province_name', 'province_code');
                                }
                            })
                            ->afterStateUpdated(function ($set) {
                                $set('city', null);
                                $set('barangay', null);
                            }),
                        Forms\Components\Select::make('city')
                            ->required()
                            ->reactive()
                            ->options(function (Get $get) {
                                if (filled($get('province'))) {
                                    return collect(PSGC::getAllCitiesByProvinceCode($get('province')))
                                        ->pluck('city_name', 'city_code');
                                }
                            })
                            ->afterStateUpdated(function ($set) {
                                $set('barangay', null);
                            }),
                        Forms\Components\Select::make('barangay')
                            ->required()
                            ->reactive()
                            ->options(function (Get $get) {
                                if (filled($get('city'))) {
                                    return collect(PSGC::getAllBarangaysByCityCode($get('city')))
                                        ->pluck('barangay_name', 'barangay_code');
                                }
                            }),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Account Access'),
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
                self::getEditAction(),
                self::getPasswordResetAction(),
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
            ->iconButton()
            ->iconSize(IconSize::Large)
            ->successNotificationMessage(fn($record) => "The customer '{$record->name}' has been updated.")
            ->modalWidth(MaxWidth::FourExtraLarge)
            ->closeModalByClickingAway(false);
    }

    // Reset Password Action
    public static function getPasswordResetAction(): Tables\Actions\Action
    {
        $raw_password = Str::random(10);

        return Tables\Actions\Action::make('resetPassword')
            ->icon('ri-lock-password-line')
            ->iconButton()
            ->iconSize(IconSize::Large)
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
