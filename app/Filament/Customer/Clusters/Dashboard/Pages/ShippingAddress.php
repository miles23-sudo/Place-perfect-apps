<?php

namespace App\Filament\Customer\Clusters\Dashboard\Pages;

use Filament\Pages\SubNavigationPosition;
use Filament\Pages\Page;
use Filament\Notifications;
use Filament\Forms\Get;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms;
use Arxjei\PSGC;
use App\Filament\Customer\Clusters\Dashboard;
use Filament\Actions;

class ShippingAddress extends Page implements HasForms
{
    use InteractsWithForms;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationIcon = 'ri-truck-line';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.customer.clusters.dashboard.pages.shipping-address';

    protected static ?string $cluster = Dashboard::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('goShopping')
                ->label('Go Shopping')
                ->icon('heroicon-o-shopping-cart')
                ->url(route('shop'))
        ];
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth('customer')->user()->customerAddress?->only(['house_number', 'street', 'region', 'province', 'city', 'barangay']) ?? []);
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('house_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('region')
                    ->required()
                    ->reactive()
                    ->options(collect(PSGC::getRegions())->pluck('region_name', 'region_code'))
                    ->afterStateUpdated(function ($set) {
                        $set('province', null);
                        $set('city', null);
                        $set('barangay', null);
                    }),
                Forms\Components\Select::make('province')
                    ->required()
                    ->reactive()
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
                    ->reactive()
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
                    ->reactive()
                    ->options(function (Get $get) {
                        if (filled($get('city'))) {
                            return collect(PSGC::getAllBarangaysByCityCode($get('city')))
                                ->pluck('barangay_name', 'barangay_code');
                        }
                    }),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        auth('customer')->user()->customerAddress()->updateOrCreate(
            ['customer_id' => auth('customer')->id()],
            $this->form->getState()
        );

        Notifications\Notification::make()
            ->title('Profile Updated')
            ->success()
            ->send();
    }
}
