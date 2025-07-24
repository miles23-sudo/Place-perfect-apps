<?php

namespace App\Filament\Clusters\Pages;


use Filament\Pages\SettingsPage;
use Filament\Forms\Form;
use Filament\Forms;
use App\Settings\ShopSetting;
use App\Rules\KeyValueUrlRule;
use App\Rules\KeyValueStartsWithRule;
use App\Rules\KeyValueLengthRule;
use App\Rules\KeyValueEmailRule;
use App\Rules\KeyValueDigitsRule;
use App\Filament\Clusters\Settings;

class GeneralSetting extends SettingsPage
{
    protected static ?string $cluster = Settings::class;

    protected static string $settings = ShopSetting::class;

    protected static ?string $navigationIcon = 'ri-equalizer-line';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contacts')
                    ->icon('ri-phone-line')
                    ->description('Manage your contact information.')
                    ->aside()
                    ->schema([
                        Forms\Components\KeyValue::make('phone_numbers')
                            ->hiddenLabel()
                            ->keyLabel('Phone Numbers')
                            ->valueLabel(false)
                            ->editableKeys(false)
                            ->addable(false)
                            ->deletable(false)
                            ->valuePlaceholder('e.g. +639xxxxxxxx')
                            ->rules([new KeyValueStartsWithRule('+639'), new KeyValueDigitsRule(13)]),
                        Forms\Components\KeyValue::make('emails')
                            ->hiddenLabel()
                            ->keyLabel('Emails')
                            ->valueLabel(false)
                            ->editableKeys(false)
                            ->addable(false)
                            ->deletable(false)
                            ->rules([new KeyValueEmailRule()]),
                    ]),
                Forms\Components\Section::make('Address')
                    ->icon('ri-map-pin-line')
                    ->description('Manage your address information.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->required(),
                        Forms\Components\Textarea::make('google_map_iframe')
                            ->required()
                            ->startsWith('<iframe')
                            ->endsWith('</iframe>')
                            ->rows(5),
                    ]),
                Forms\Components\Section::make('Social Media')
                    ->icon('ri-facebook-line')
                    ->description('Manage your social media links.')
                    ->aside()
                    ->schema([
                        Forms\Components\KeyValue::make('social_media_links')
                            ->hiddenLabel()
                            ->keyLabel('Platform')
                            ->valueLabel(false)
                            ->editableKeys(false)
                            ->addable(false)
                            ->deletable(false)
                            ->valuePlaceholder('e.g. https://platform.com/yourpage')
                            ->rules([new KeyValueUrlRule()])
                    ])

            ]);
    }
}
