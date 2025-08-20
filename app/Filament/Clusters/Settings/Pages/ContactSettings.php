<?php

namespace App\Filament\Clusters\Settings\Pages;


use Filament\Pages\SettingsPage;
use Filament\Forms\Form;
use Filament\Forms;
use App\Settings\Contact;
use App\Rules\KeyValueUrlRule;
use App\Rules\KeyValueStartsWithRule;
use App\Rules\KeyValueEmailRule;
use App\Rules\KeyValueDigitsRule;
use App\Rules\AcrossValenzuelaOnly;
use Cheesegrits\FilamentGoogleMaps;
use App\Filament\Clusters\Settings;


class ContactSettings extends SettingsPage
{
    protected static ?string $cluster = Settings::class;

    protected static string $settings = Contact::class;

    protected static ?string $navigationIcon = 'phosphor-phone-duotone';

    protected static ?string $navigationLabel = "Contacts";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Phone Numbers and Emails')
                    ->description('Customer support contact information.')
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
                    ->description('Physical address and Google Maps iframe.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->live()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('latitude')
                            ->required()
                            ->live()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('longitude')
                            ->required()
                            ->live()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('google_map_iframe')
                            ->rows(5)
                            ->required()
                            ->startsWith('<iframe')
                            ->endsWith('</iframe>')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Social Media')
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
