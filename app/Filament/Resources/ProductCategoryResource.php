<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\ProductCategory;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Filament\Resources\ProductCategoryResource\Pages;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    // protected static ?string $navigationIcon = 'ri-bookmark-3-line';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->required()
                    ->directory('product-categories')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->lazy()
                    ->maxLength(255)
                    ->afterStateUpdated(function ($state, Set $set) {
                        $set('slug', str()->slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->helperText('This will be automatically generated from the name field.')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->readOnly(),
                Forms\Components\RichEditor::make('short_description')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->required()
                    ->maxLength(2048)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Availability'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('products_count')
                    ->counts('products')
                    ->searchable(),
            ])
            ->actions([
                self::getEditAction(),
                Tables\Actions\ReplicateAction::make()
                    ->icon('ri-file-copy-line')
                    ->iconSize(IconSize::Large)
                    ->iconButton()
                    ->excludeAttributes(['products_count'])
                    ->beforeReplicaSaved(function ($replica, $record): void {
                        $replica->name = $replica->name . '-copy-' . now()->timestamp;
                        $replica->slug = Str::slug($replica->name);
                    })
                    ->closeModalByClickingAway(false),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductCategories::route('/'),
        ];
    }

    // Custom Action 

    // Edit Action
    public static function getEditAction(): Tables\Actions\EditAction
    {
        return Tables\Actions\EditAction::make()
            ->icon('ri-pencil-line')
            ->iconSize(IconSize::Large)
            ->iconButton()
            ->closeModalByClickingAway(false);
    }
}
