<?php

namespace App\Filament\Resources;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\Pages;
use App\Enums\OrderStatus;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'ri-shopping-cart-2-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Information')
                        ->schema([
                            Forms\Components\ToggleButtons::make('status')
                                ->inline()
                                ->options(OrderStatus::class)
                                ->default(OrderStatus::Pending),
                            Forms\Components\Select::make('customer_id')
                                ->label('Customer')
                                ->native(false)
                                ->searchable()
                                ->preload()
                                ->live(onBlur: true)
                                ->required()
                                ->options(Customer::all()->pluck('user.name', 'id'))
                                ->afterStateUpdated(function (Set $set, $state) {
                                    $customer = Customer::find($state);

                                    if (!$customer) return;

                                    $set('phone_number', $customer->phone_number);
                                    $set('house_number', $customer->house_number);
                                    $set('street', $customer->street);
                                    $set('region', $customer->region_name);
                                    $set('province', $customer->province_name);
                                    $set('city', $customer->city_name);
                                    $set('barangay', $customer->barangay_name);
                                }),
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\TextInput::make('phone_number')
                                        ->tel()
                                        ->live(onBlur: true)
                                        ->required()
                                        ->startsWith('09')
                                        ->length(11),
                                    Forms\Components\TextInput::make('house_number')
                                        ->live(onBlur: true)
                                        ->required(),
                                    Forms\Components\TextInput::make('street')
                                        ->live(onBlur: true)
                                        ->required(),
                                    Forms\Components\TextInput::make('region')
                                        ->live(onBlur: true)
                                        ->required(),
                                    Forms\Components\TextInput::make('province')
                                        ->live(onBlur: true)
                                        ->required(),
                                    Forms\Components\TextInput::make('city')
                                        ->live(onBlur: true)
                                        ->required(),
                                    Forms\Components\TextInput::make('barangay')
                                        ->live(onBlur: true)
                                        ->required(),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('additional_notes')
                                ->rows(5)
                                ->columnSpanFull(),
                        ]),
                    Forms\Components\Wizard\Step::make('Items')
                        ->schema([
                            Forms\Components\Repeater::make('items')
                                ->schema([
                                    Forms\Components\Select::make('product_id')
                                        ->label('Product')
                                        ->native(false)
                                        ->searchable()
                                        ->preload()
                                        ->live(onBlur: true)
                                        ->required()
                                        ->distinct()
                                        ->options(Product::isActive()->pluck('name', 'id'))
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            $product = Product::find($state);

                                            if (!$product) return;

                                            $set('price', $product->price);
                                        }),
                                    Forms\Components\Group::make()
                                        ->schema([
                                            Forms\Components\TextInput::make('price')
                                                ->prefix('₱')
                                                ->mask(RawJs::make('$money($input)'))
                                                ->stripCharacters(',')
                                                ->live(onBlur: true)
                                                ->required()
                                                ->numeric()
                                                ->maxValue(99999999.99)
                                                ->readOnly(),
                                            Forms\Components\TextInput::make('quantity')
                                                ->reactive()
                                                ->required()
                                                ->numeric()
                                                ->minValue(1)
                                                ->maxValue(100),
                                        ])
                                        ->columns(2)
                                        ->columnSpanFull(),
                                ])
                                ->minItems(1)
                                ->maxItems(10)
                                ->collapsible(),
                            Forms\Components\Placeholder::make('Overall price')
                                ->content(function (Get $get): string {
                                    if (filled($get('items'))) {
                                        $total = collect($get('items'))->sum(fn($item) => (float) $item['price'] * (int) $item['quantity']);

                                        return '₱' . number_format($total, 2);
                                    }
                                    return '₱0.00';
                                }),
                        ])
                ])
                    ->columnSpanFull()
                    ->submitAction(new HtmlString(Blade::render(<<<BLADE
                        <x-filament::button type="submit" size="sm">
                            Submit
                        </x-filament::button>
                    BLADE)))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('overall_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ordered_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('paid_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}
