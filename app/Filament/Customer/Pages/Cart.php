<?php

namespace App\Filament\Customer\Pages;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Cart as CartModel;

class Cart extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'phosphor-shopping-bag-open-duotone';

    protected static string $view = 'filament.customer.pages.cart';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(CartModel::query()->whereCustomerId(auth('customer')->id()))
            ->columns([
                Tables\Columns\ImageColumn::make('product.images'),
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('product.category.name'),
                    Tables\Columns\TextColumn::make('product.name'),
                ])

            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->paginated(false)
            ->bulkActions([
                // ...
            ]);
    }
}
