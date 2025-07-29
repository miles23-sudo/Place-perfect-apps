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
use App\Models\Feedback;
use App\Filament\Resources\FeedbackResource\Pages;


class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'ri-chat-1-line';

    protected static ?string $navigationGroup = 'Customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('customer_id')
                    ->label('Customer')
                    ->content(fn($record) => $record->customer->name),
                Forms\Components\Placeholder::make('product_id')
                    ->label('Product')
                    ->content(fn($record) => $record->product->name),
                FilamentRating\Components\Rating::make('rating')
                    ->theme(RatingTheme::Simple)
                    ->size('sm')
                    ->disabled(),
                Forms\Components\Placeholder::make('comment')
                    ->content(fn($record) => $record->comment),
                Forms\Components\RichEditor::make('response')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->required()
                    ->maxLength(250)
                    ->columnSpanFull(),
            ])
            ->columns(1);
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
                Tables\Columns\TextColumn::make('response_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ActionGroup::make([
                    self::getEditAction(),
                ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
        ];
    }

    // Actions 

    // Edit Action
    public static function getEditAction(): Tables\Actions\EditAction
    {
        return Tables\Actions\EditAction::make()
            ->label('Respond')
            ->icon('ri-send-plane-line')
            ->modalHeading('Respond to Feedback')
            ->modalSubmitActionLabel('Submit Response')
            ->modalWidth(MaxWidth::TwoExtraLarge)
            ->successNotificationMessage(fn($record) => "The feedback response has been submitted.")
            ->closeModalByClickingAway(false);
    }

    // Helper 

    // Rating Display
    public static function getRatingDisplay($record): HtmlString
    {
        return new HtmlString(
            '<div class="flex items-center space-x-1">' .
                str_repeat(Blade::render(<<<BLADE
                <x-ri-star-fill class="w-4 h-4 text-gray-500 fill-current" />
            BLADE), $record->rating) .
                str_repeat(Blade::render(<<<BLADE
                <x-ri-star-line class="w-4 h-4 text-gray-500 fill-current" />
            BLADE), 5 - $record->rating) .
                '</div>'
        );
    }
}
