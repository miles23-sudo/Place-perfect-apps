<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

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
            ->label('Add Product')
            ->icon('ri-add-line');
    }
}
