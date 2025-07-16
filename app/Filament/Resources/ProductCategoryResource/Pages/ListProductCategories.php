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
            $this->getCreateAction(),
        ];
    }

    // Custom Actions

    // Create Action
    public function getCreateAction(): Actions\CreateAction
    {
        return Actions\CreateAction::make()
            ->label('Add Product Category')
            ->icon('ri-add-line');
    }
}
