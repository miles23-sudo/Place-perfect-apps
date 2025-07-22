<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
use App\Filament\Resources\ProductResource;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCreateAction()
        ];
    }

    // Action

    // Create Action
    public function getCreateAction(): Actions\CreateAction
    {
        return Actions\CreateAction::make()
            ->icon('ri-add-line')
            ->successNotificationMessage(fn($record) => "The product '{$record->name}' has been created.")
            ->modalWidth(MaxWidth::SevenExtraLarge)
            ->closeModalByClickingAway(false);
    }
}
