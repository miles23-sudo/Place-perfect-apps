<?php

namespace App\Filament\Resources;

use Illuminate\Support\Facades\Storage;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\ProductCategory;
use App\Filament\Resources\ProductCategoryResource\Pages;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'ri-stack-line';

    protected static ?string $navigationGroup = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->lazy()
                    ->required()
                    ->image()
                    ->imageCropAspectRatio('1:1')
                    ->columnSpanFull()
                    ->directory('product-categories'),
                Forms\Components\TextInput::make('name')
                    ->live(onBlur: true)
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true)
                    ->afterStateUpdated(function ($state, $set) {
                        $set('slug', str($state)->slug());
                    }),
                Forms\Components\TextInput::make('slug')
                    ->hintIcon('ri-information-line')
                    ->hintIconTooltip('This will be automatically generated based on the name.')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                Forms\Components\Textarea::make('short_description')
                    ->rows(5)
                    ->required()
                    ->maxLength(100)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Availability'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ActionGroup::make([
                    self::getEditAction()
                ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductCategories::route('/'),
        ];
    }

    // Actions

    // Edit Action
    public static function getEditAction(): Tables\Actions\EditAction
    {
        return Tables\Actions\EditAction::make()
            ->mutateFormDataUsing(function ($record, $data) {
                $filled_data = $record->fill($data);

                if ($filled_data->isDirty('image')) {
                    $old_image = $record->getOriginal('image');

                    Storage::disk('public')->delete($old_image);
                }
                return $data;
            })
            ->successNotificationMessage(fn($record) => "The product category '{$record->name}' has been updated.")
            ->modalWidth(MaxWidth::FourExtraLarge)
            ->closeModalByClickingAway(false);
    }
}
