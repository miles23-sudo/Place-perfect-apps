<?php

namespace App\Filament\Resources;

use App\Enums\OrderPaymentMode;
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
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Product;
use App\Models\Order;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\Pages;
use App\Enums\OrderStatus;
use App\Models\Customer;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'phosphor-truck-duotone';

    protected static ?string $navigationGroup = 'Customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Items')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->relationship('product', 'name', modifyQueryUsing: fn(Builder $query) => $query->isActive())
                                    ->required()
                                    ->reactive()
                                    ->distinct()
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        if (filled($state)) {
                                            $product = Product::find($state);
                                            $set('price', $product->price);
                                        }
                                    }),
                                Forms\Components\TextInput::make('price')
                                    ->hint('Auto-filled')
                                    ->prefix('₱')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->step(0.01)
                                    ->readOnly(),
                                Forms\Components\TextInput::make('quantity')
                                    ->required()
                                    ->reactive()
                                    ->numeric()
                                    ->minValue(1)
                                    ->step(1)
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                        if (filled($get('price')) && filled($state) && intval($state) > 0) {
                                            $set('quantity', intval($state));
                                        }
                                    }),
                                Forms\Components\Placeholder::make('total_price')
                                    ->label('Total Price')
                                    ->reactive()
                                    ->content(function (Get $get) {
                                        if (filled($get('price')) && filled($get('quantity'))) {
                                            return '₱' . number_format($get('price') * $get('quantity'), 2);
                                        }

                                        return '₱0.00';
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
                    ])
                    ->columnSpan(2),
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make('Customer')
                            ->schema([
                                Forms\Components\Select::make('customer_id')
                                    ->relationship('customer', 'name', modifyQueryUsing: fn(Builder $query) => $query->whereHas('customerAddress'))
                                    ->native(false)
                                    ->searchable()
                                    ->preload()
                                    ->reactive(),
                                Forms\Components\Placeholder::make('summary')
                                    ->hiddenLabel()
                                    ->reactive()
                                    ->content(function (Get $get) {
                                        $customer = Customer::find($get('customer_id'));
                                        return view('filament.misc.order-resource.customer-profile', compact('customer'));
                                    })
                                    ->visible(fn(Get $get) => filled($get('customer_id')))
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Section::make('Shipping & Payment')
                            ->schema([
                                Forms\Components\Placeholder::make('subtotal')
                                    ->label('SubTotal')
                                    ->inlineLabel()
                                    ->reactive()
                                    ->content(function (Get $get) {
                                        if (filled($get('items'))) {
                                            $total = array_reduce($get('items'), fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
                                            return '₱' . number_format($total, 2);
                                        }
                                    }),
                                Forms\Components\Placeholder::make('shipping_fee')
                                    ->label('Shipping Fee')
                                    ->inlineLabel()
                                    ->reactive()
                                    ->content(function (Get $get) {
                                        if (filled($get('customer_id'))) {
                                            $customer = Customer::find($get('customer_id'));
                                            return '₱' . $customer->customerAddress->shipping_fee;
                                        }

                                        return '₱0.00';
                                    }),
                                Forms\Components\Placeholder::make('overall_total')
                                    ->label('Overall Total')
                                    ->inlineLabel()
                                    ->reactive()
                                    ->content(function (Get $get) {
                                        if (filled($get('items')) && filled($get('customer_id'))) {
                                            $customer = Customer::find($get('customer_id'));

                                            $sub_total = array_reduce($get('items'), fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
                                            $shipping_fee = $customer->customerAddress->shipping_fee;
                                            $overall_total = floatval($sub_total) + floatval($shipping_fee);

                                            return '₱' . number_format($overall_total, 2);
                                        }

                                        return '₱0.00';
                                    })
                                    ->disabled(),
                                Forms\Components\ToggleButtons::make('payment_mode')
                                    ->required()
                                    ->reactive()
                                    ->inline()
                                    ->options(OrderPaymentMode::class),
                                Forms\Components\ToggleButtons::make('payment_channel')
                                    ->required()
                                    ->reactive()
                                    ->inline()
                                    ->options(app(\App\Settings\Payment::class)->getAssociativeArrayOfOnlineChannels())
                                    ->visible(fn(Get $get) => $get('payment_mode') == OrderPaymentMode::Online->value),
                            ]),
                    ])
                    ->columns(1)
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(1)
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
                            ]),
                        Infolists\Components\Section::make('Return/Refund Details')
                            ->schema([
                                Infolists\Components\TextEntry::make('return_reason')
                                    ->label('Reason'),
                                Infolists\Components\ImageEntry::make('return_photos')
                                    ->label('Photos')
                                    ->disk('local')
                                    ->visibility('private')
                                    ->size(100),
                            ])
                            ->visible(fn($record) => $record->isInReturnRefund()),
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
