<?php

namespace App\Filament\Clusters\Settings\Pages;


use Filament\Pages\SettingsPage;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use Cheesegrits\FilamentGoogleMaps;
use App\Settings\Contact;
use App\Rules\KeyValueUrlRule;
use App\Rules\KeyValueStartsWithRule;
use App\Rules\KeyValueEmailRule;
use App\Rules\KeyValueDigitsRule;
use App\Rules\AcrossValenzuelaOnly;
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
                            ->unique()
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
                            ->hint('Auto-generated')
                            ->required()
                            ->reactive()
                            ->lazy()
                            ->maxLength(255)
                            ->readOnly(),
                        Forms\Components\TextInput::make('longitude')
                            ->hint('Auto-generated')
                            ->required()
                            ->reactive()
                            ->lazy()
                            ->maxLength(255)
                            ->readOnly(),
                        FilamentGoogleMaps\Fields\Map::make('location')
                            ->mapControls([
                                'mapTypeControl'    => true,
                                'scaleControl'      => true,
                                'streetViewControl' => true,
                                'rotateControl'     => true,
                                'fullscreenControl' => true,
                                'searchBoxControl'  => false,
                                'zoomControl'       => false,
                            ])
                            ->defaultZoom(18)
                            ->reverseGeocode([
                                'address' => '%n %S, %L, %A1, %z, %C',
                            ])
                            ->defaultLocation(function (Get $get) {
                                if (filled($get('latitude')) && filled($get('longitude'))) {
                                    return [$get('latitude'), $get('longitude')];
                                }

                                return [14.69292810676326, 120.96940195544433];
                            })
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                $set('latitude', $state['lat']);
                                $set('longitude', $state['lng']);
                            })
                            ->geolocate()
                            ->geolocateOnLoad()
                            ->draggable()
                            ->clickable(false)
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
