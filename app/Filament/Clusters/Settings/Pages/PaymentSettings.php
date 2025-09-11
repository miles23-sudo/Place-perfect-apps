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
                Forms\Components\Section::make('Online Channels')
                    ->description('Add or remove online payment channels.')
                    ->aside()
                    ->schema([
                        Forms\Components\Repeater::make('online_channels')
                            ->label('Channels')
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->label('Channel Logo')
                                    ->image()
                                    ->maxSize(1024)
                                    ->directory('payment-logos')
                                    ->imageCropAspectRatio('1:1')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('name')
                                    ->label('Channel Name')
                                    ->required()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('account_number')
                                    ->label('Account Number')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->minItems(1)
                            ->maxItems(5)
                            ->reorderable(false)
                            ->columns(2),
                    ]),
                Forms\Components\Section::make('Terms and Conditions')
                    ->description('Set the terms and conditions for delivery.')
                    ->aside()
                    ->schema([
                        Forms\Components\RichEditor::make('payment_terms')
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
