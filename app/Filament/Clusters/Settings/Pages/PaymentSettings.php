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

    protected static ?string $navigationIcon = 'phosphor-hand-coins-duotone';

    protected static ?string $navigationLabel = "Payments";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Cash on Delivery')
                    ->description('Enable or disable cash on delivery option.')
                    ->aside()
                    ->schema([
                        Forms\Components\Toggle::make('is_cod_enabled')
                            ->label('Enable Cash on Delivery')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Terms and Conditions')
                    ->description('Set the terms and conditions for delivery.')
                    ->aside()
                    ->schema([
                        Forms\Components\RichEditor::make('payment_terms')
                            ->disableToolbarButtons([
                                'blockquote',
                                'strike',
                            ])
                    ]),
            ]);
    }
}
