<?php

namespace App\Filament\Resources;

use Illuminate\Support\Facades\Storage;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables;
use Filament\Support\RawJs;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Product;
use App\Filament\Resources\ProductResource\Pages;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'ri-sofa-line';

    protected static ?string $navigationGroup = 'Catalog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Details')
                    ->schema([
                        Forms\Components\Select::make('product_category_id')
                            ->required()
                            ->relationship('productCategory', 'name'),
                        Forms\Components\TextInput::make('name')
                            ->live(onBlur: true)
                            ->required()
                            ->maxLength(255)
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
                        Forms\Components\TextInput::make('price')
                            ->prefix('₱')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->required()
                            ->numeric()
                            ->maxValue(99999999.99),
                        Forms\Components\RichEditor::make('short_description')
                            ->disableToolbarButtons([
                                'attachFiles',
                            ])
                            ->required()
                            ->maxLength(250)
                            ->columnSpanFull(),
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
                    ])
                    ->columnSpan(2),
                Forms\Components\Fieldset::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('ar_image')
                            ->label('AR Image for Android')
                            ->hintIcon('ri-information-line')
                            ->hintIconTooltip('This image will be used to scale the product accurately in Augmented Reality. Please ensure it reflects the real-world dimensions of the product. Proper sizing helps maintain a realistic AR experience.')
                            ->helperText('Supported formats: GLTF, GLB')
                            ->maxSize(30 * 1024)
                            ->acceptedFileTypes([
                                'model/gltf-binary',
                                'model/gltf+json',
                            ])
                            ->directory('product-ar-images'),
                        Forms\Components\FileUpload::make('ar_image_ios')
                            ->label('AR Image for iOS')
                            ->hintIcon('ri-information-line')
                            ->hintIconTooltip('This image will be used to scale the product accurately in Augmented Reality. Please ensure it reflects the real-world dimensions of the product. Proper sizing helps maintain a realistic AR experience.')
                            ->helperText('Supported formats: USDZ')
                            ->required(fn(Get $get) => filled($get('ar_image')))
                            ->maxSize(30 * 1024)
                            ->mimeTypeMap([
                                'usdz' => 'model/vnd.usdz+zip',
                            ])
                            ->directory('product-ar-images'),
                        Forms\Components\FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->imageCropAspectRatio('1:1')
                            ->previewable(false)
                            ->required()
                            ->maxFiles(5)
                            ->maxSize(20 * 1024)
                            ->directory('product-images'),
                    ])
                    ->columns(1)
                    ->columnSpan(1)
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Availability'),
                Tables\Columns\TextColumn::make('productCategory.name'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('has_ar_image')
                    ->label('AR Support'),
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
            'index' => Pages\ListProducts::route('/'),
        ];
    }

    // Actions

    // Edit Action
    public static function getEditAction(): Tables\Actions\EditAction
    {
        return Tables\Actions\EditAction::make()
            ->mutateFormDataUsing(function ($record, $data) {
                if ($record->ar_image) {
                    $filled_data = $record->fill($data);

                    if ($filled_data->isDirty('ar_image')) {
                        $old_ar_image = $record->getOriginal('ar_image');
                        Storage::disk('public')->delete($old_ar_image);
                    }

                    if ($filled_data->isDirty('ar_image_ios')) {
                        $old_ar_image_ios = $record->getOriginal('ar_image_ios');
                        Storage::disk('public')->delete($old_ar_image_ios);
                    }
                }

                return $data;
            })
            ->successNotificationMessage(fn($record) => "The product '{$record->name}' has been updated.")
            ->modalWidth(MaxWidth::SevenExtraLarge)
            ->closeModalByClickingAway(false);
    }
}
