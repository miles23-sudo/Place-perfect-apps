<?php

namespace App\Filament\Clusters\Settings\Pages;

use Filament\Pages\SettingsPage;
use Filament\Forms\Form;
use Filament\Forms;
use App\Settings\Payment;
use App\Filament\Clusters\Settings;
use App\Enums\OrderPaymentMethod;

class PaymentSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = Payment::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Channel')
                    ->icon('ri-map-pin-line')
                    ->description('Refer to the Paymongo documentation for available payment methods.')
                    ->aside()
                    ->schema([
                        Forms\Components\Repeater::make('methods')
                            ->collapsible()
                            ->schema([
                                Forms\Components\Toggle::make('is_enabled')
                                    ->label('Available')
                                    ->required(),
                                Forms\Components\TextInput::make('channel')
                                    ->required()
                                    ->datalist(fn() => app(Payment::class)->getAllChannels())
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('label')
                                    ->required(),
                                Forms\Components\TextInput::make('paymongo_id')
                                    ->label('Paymongo ID')
                                    ->hintIconTooltip('This is the ID used by Paymongo to identify the payment method.')
                                    ->required(),
                            ])
                            ->columns(2)
                    ]),
                Forms\Components\Section::make('Cash on Delivery')
                    ->icon('ri-map-pin-line')
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
