<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

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
            ->label('Create Order')
            ->icon('ri-add-line')
            ->after(function ($record, $data) {
                dd($record, $data);
            })
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->closeModalByClickingAway(false);
    }
}
