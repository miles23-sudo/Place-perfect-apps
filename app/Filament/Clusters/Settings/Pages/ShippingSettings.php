<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\Shipping;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Pages\SettingsPage;

class ShippingSettings extends SettingsPage
{

    protected static string $settings = Shipping::class;

    protected static ?string $cluster = Settings::class;

    protected static ?string $navigationIcon = 'phosphor-truck-duotone';

    protected static ?string $navigationLabel = "Shipping";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Shipping Fee')
                    ->description('By Disabling this, all items will be free of shipping charges.')
                    ->aside()
                    ->schema([
                        Forms\Components\Toggle::make('is_shipping_enable')
                            ->label('Enable Shipping')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Fees')
                    ->description('Set the shipping fees for different delivery options.')
                    ->aside()
                    ->schema([
                        Forms\Components\Repeater::make('distance_fee')
                            ->schema([
                                Forms\Components\Select::make('distance_range')
                                    ->required()
                                    ->distinct()
                                    ->options(collect(range(0, 8))->flatMap(fn($i) => [
                                        ($i * 2) . '-' . ($i * 2 + 1) => ($i * 2) . ' - ' . ($i * 2 + 1) . ' km',
                                    ])),
                                Forms\Components\TextInput::make('fee')
                                    ->required()
                                    ->numeric()
                                    ->step(0.01),
                            ])
                            ->orderable(false)
                            ->columns(2)
                    ]),
                Forms\Components\Section::make('Terms and Conditions')
                    ->description('Set the terms and conditions for delivery.')
                    ->aside()
                    ->schema([
                        Forms\Components\RichEditor::make('delivery_terms')
                            ->required()
                            ->maxlength(10000)
                            ->disableToolbarButtons([
                                'blockquote',
                                'strike',
                            ])
                    ]),
            ]);
    }
}
