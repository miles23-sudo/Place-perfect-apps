<?php

namespace App\Filament\Resources;

use Jaydoesphp\PSGCphp\PSGC;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Customer;
use App\Filament\Resources\CustomerResource\Pages;
use App\Enums\UserRole;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'ri-team-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->relationship('user')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->startsWith('09')
                    ->length(11),
                Forms\Components\TextInput::make('house_number')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('region')
                    ->required()
                    ->live()
                    ->options(collect(PSGC::getRegions())->pluck('region_name', 'region_code'))
                    ->afterStateUpdated(function ($set) {
                        $set('province', null);
                        $set('city', null);
                        $set('barangay', null);
                    }),
                Forms\Components\Select::make('province')
                    ->required()
                    ->live()
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
                    ->live()
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
                    ->live()
                    ->options(function (Get $get) {
                        if (filled($get('city'))) {
                            return collect(PSGC::getAllBarangaysByCityCode($get('city')))
                                ->pluck('barangay_name', 'barangay_code');
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query
                ->whereHas('user', function (Builder $query) {
                    $query->where('role', UserRole::Customer);
                }))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region_name')
                    ->label('Region'),
                Tables\Columns\TextColumn::make('province_name')
                    ->label('Province'),
            ])
            ->actions([
                self::getEditAction(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
        ];
    }

    // Custom Action 

    // Edit Action
    public static function getEditAction(): Tables\Actions\EditAction
    {
        return Tables\Actions\EditAction::make()
            ->icon('ri-pencil-line')
            ->iconSize(IconSize::Large)
            ->iconButton()
            ->closeModalByClickingAway(false);
    }
}
