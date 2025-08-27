<?php

namespace App\Filament\Resources;

use Mokhosh\FilamentRating\RatingTheme;
use Mokhosh\FilamentRating;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Review;
use App\Filament\Resources\ReviewResource\Pages;
use Filament\Infolists;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'phosphor-star-duotone';

    protected static ?string $navigationGroup = 'Customers';

    public static function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('customer.name')
                    ->label('Customer'),
                Infolists\Components\TextEntry::make('product.name')
                    ->label('Product'),
                FilamentRating\Entries\RatingEntry::make('rating')
                    ->theme(RatingTheme::Simple)
                    ->size('sm'),
                Infolists\Components\TextEntry::make('review'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Time Ago')
                    ->since()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->searchable(),
                FilamentRating\Columns\RatingColumn::make('rating')
                    ->theme(RatingTheme::Simple)
                    ->size('sm')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                self::getViewAction(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReview::route('/'),
        ];
    }

    // Actions

    // View Action
    public static function getViewAction(): Tables\Actions\ViewAction
    {
        return Tables\Actions\ViewAction::make()
            ->modalWidth(MaxWidth::TwoExtraLarge)
            ->button();
    }
}
