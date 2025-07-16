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
use App\Filament\Resources\CustomerResource\RelationManagers;
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
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->startsWith('09')
                    ->length(11)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('house_number')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('region')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('province')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('barangay')
                    ->required()
                    ->maxLength(50),
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
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('house_number')
                    ->limit(50),
                Tables\Columns\TextColumn::make('street')
                    ->limit(50),
                Tables\Columns\TextColumn::make('barangay')
                    ->limit(50),
                Tables\Columns\TextColumn::make('city')
                    ->limit(50),
                Tables\Columns\TextColumn::make('province')
                    ->limit(50),
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
