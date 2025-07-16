<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Support\RawJs;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Product;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductCategoryResource;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_category_id')
                    ->relationship('productCategory', 'name')
                    ->required()
                    ->createOptionForm(fn(Form $form) => ProductCategoryResource::form($form))
                    ->editOptionForm(fn(Form $form) => ProductCategoryResource::form($form)),
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->previewable(false)
                            ->required()
                            ->image()
                            ->maxFiles(5)
                            ->maxSize(20 * 1024)
                            ->directory('products'),
                        Forms\Components\FileUpload::make('ar_image')
                            ->maxFiles(1)
                            ->maxSize(10 * 1024)
                            ->acceptedFileTypes([
                                'model/gltf-binary',
                                'model/gltf+json',
                            ])
                            ->directory('product-ar-images'),
                    ]),
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
                Forms\Components\TextInput::make('price')
                    ->prefix('₱')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required()
                    ->numeric()
                    ->maxValue(99999999.99),
                Forms\Components\RichEditor::make('description')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->required()
                    ->maxLength(2048)
                    ->columnSpanFull(),
                Forms\Components\KeyValue::make('features')
                    ->keyLabel('Label')
                    ->keyPlaceholder('e.g. Color')
                    ->valuePlaceholder('e.g. Red')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Availability'),
                Tables\Columns\ImageColumn::make('images')
                    ->stacked(),
                Tables\Columns\TextColumn::make('productCategory.name'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('PHP')
                    ->sortable(),
            ])
            ->actions([
                self::getEditAction(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
