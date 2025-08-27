<?php

namespace App\Filament\Resources;

use JaOcero\ActivityTimeline\Enums\IconAnimation;
use JaOcero\ActivityTimeline\Components\ActivityTitle;
use JaOcero\ActivityTimeline\Components\ActivitySection;
use JaOcero\ActivityTimeline\Components\ActivityIcon;
use JaOcero\ActivityTimeline\Components\ActivityDescription;
use JaOcero\ActivityTimeline\Components\ActivityDate;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Resources\Resource;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Order;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\Pages;
use App\Enums\OrderStatus;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'phosphor-truck-duotone';

    protected static ?string $navigationGroup = 'Customers';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::toPay()->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer & Order Details')
                    ->schema([
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Order Date & Time')
                            ->required(),
                        Forms\Components\DateTimePicker::make('paid_at')
                            ->label('Paid Date & Time')
                            ->hidden(fn($state) => blank($state)),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Statuses')
                    ->schema([
                        Forms\Components\ToggleButtons::make('status')
                            ->inline()
                            ->required()
                            ->options(OrderStatus::class)
                            ->disableOptionWhen(fn($state) => $state === OrderStatus::ToPay),
                    ]),
            ]);
    }

    public static function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Order Details')
                    ->schema([
                        Infolists\Components\Fieldset::make('Transaction')
                            ->schema([
                                Infolists\Components\TextEntry::make('id')
                                    ->label('Order ID'),
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Order Date')
                                    ->dateTime('F j, Y, g:i A'),
                                Infolists\Components\TextEntry::make('status')
                                    ->badge(),
                            ]),
                        Infolists\Components\Fieldset::make('Payment')
                            ->schema([
                                Infolists\Components\TextEntry::make('payment_mode')
                                    ->badge(),
                                Infolists\Components\TextEntry::make('payment_channel')
                                    ->badge(),
                                Infolists\Components\TextEntry::make('subtotal')
                                    ->money('PHP', true),
                                Infolists\Components\TextEntry::make('shipping_fee')
                                    ->money('PHP', true),
                                Infolists\Components\TextEntry::make('overall_total')
                                    ->money('PHP', true)
                                    ->weight(FontWeight::ExtraBold),
                                Infolists\Components\ImageEntry::make('payment_proof')
                                    ->label('Proof of Payment')
                                    ->disk('local')
                                    ->visibility('private'),
                            ]),
                    ])
                    ->columnSpan(2),
                Infolists\Components\Grid::make(1)
                    ->schema([
                        Infolists\Components\Section::make('Customer')
                            ->schema([
                                Infolists\Components\TextEntry::make('customer.name')
                                    ->label('Name'),
                                Infolists\Components\TextEntry::make('customer.email')
                                    ->label('Email'),
                                Infolists\Components\TextEntry::make('customer.phone_number')
                                    ->label('Phone Number'),
                                Infolists\Components\TextEntry::make('customer.customerAddress.address')
                                    ->label('Address')
                                    ->hintAction(
                                        Infolists\Components\Actions\Action::make('viewOnMap')
                                            ->label('View on Map')
                                            ->icon('phosphor-map-pin-duotone')
                                            ->url(fn($record) => 'https://www.google.com/maps/place/' . $record->customer->customerAddress->latitude . ',' . $record->customer->customerAddress->longitude)
                                            ->openUrlInNewTab()
                                    )
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                        ActivitySection::make('status_activity')
                            ->label('Timeline')
                            ->schema([
                                ActivityTitle::make('title'),
                                ActivityDescription::make('description'),
                                ActivityDate::make('created_at')
                                    ->date('F j, Y'),
                                ActivityIcon::make('status'),
                            ])
                            ->columnSpanFull()
                            ->emptyStateHeading('No activities yet.')
                            ->emptyStateDescription('Check back later for activities that have been recorded.')
                            ->emptyStateIcon('heroicon-o-bolt-slash')
                    ])
                    ->columnSpan(1)
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order #')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('F j, Y, g:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('overall_total')
                    ->label('Total')
                    ->money('PHP', true),
                Tables\Columns\TextColumn::make('payment_mode')
                    ->label('Mode')
                    ->badge(),
                Tables\Columns\TextColumn::make('payment_channel')
                    ->label('Channel'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(query: fn(Builder $query) => $query->orderBy('status', 'asc')),
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items'),
            ])
            ->actions([
                self::getViewAction(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }

    // Custom Actions

    // View Action
    public static function getViewAction(): Tables\Actions\ViewAction
    {
        return Tables\Actions\ViewAction::make()
            ->button();
    }
}
