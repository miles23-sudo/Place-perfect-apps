<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use Filament\Actions;
use App\Filament\Resources\ProductCategoryResource;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

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
            ->successNotificationMessage(fn($record) => "The product category '{$record->name}' has been created.")
            ->modalWidth(MaxWidth::FourExtraLarge);
    }
}
