<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use App\Filament\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCreateProductCategoryAction(),
        ];
    }

    // Custom Actions

    // Create Action
    public function getCreateProductCategoryAction(): Actions\CreateAction
    {
        return Actions\CreateAction::make()
            ->label('Add Product Category')
            ->icon('gmdi-add-o');
    }
}
