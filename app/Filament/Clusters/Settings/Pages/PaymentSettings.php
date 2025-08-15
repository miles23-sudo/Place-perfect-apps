<?php

namespace App\Filament\Clusters\Settings\Pages;

use Filament\Support\Enums\MaxWidth;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms;
use App\Settings\Payment;
use App\Filament\Clusters\Settings;

class PaymentSettings extends SettingsPage
{

    protected static string $settings = Payment::class;

    protected static ?string $cluster = Settings::class;

    protected static ?string $navigationIcon = 'ri-hand-coin-line';

    protected static ?string $navigationLabel = "Payments";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Channel')
                    ->description('Refer to the Paymongo documentation for available payment methods.')
                    ->aside()
                    ->schema([
                        Forms\Components\Repeater::make('methods')
                            ->collapsible()
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->required(),
                                Forms\Components\TextInput::make('paymongo_id')
                                    ->label('Paymongo ID')
                                    ->hintIconTooltip('This is the ID used by Paymongo to identify the payment method.')
                                    ->required(),
                            ])
                            ->minItems(1)
                            ->columns(2)
                    ]),
                Forms\Components\Section::make('Cash on Delivery')
                    ->description('Enable or disable cash on delivery option.')
                    ->aside()
                    ->schema([
                        Forms\Components\Toggle::make('is_cod_enabled')
                            ->label('Enable Cash on Delivery')
                            ->required(),
                    ]),
            ]);
    }
}
