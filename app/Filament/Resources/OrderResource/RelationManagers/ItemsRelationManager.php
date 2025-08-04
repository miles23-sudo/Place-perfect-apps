<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_id')
            ->columns([
                Tables\Columns\ImageColumn::make('product.images')
                    ->circular()
                    ->stacked(),
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('price')
                    ->money('PHP', true),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('PHP', true),
                Tables\Columns\TextColumn::make('order.status')
                    ->label('Status')
                    ->badge(),
            ]);
    }
}
