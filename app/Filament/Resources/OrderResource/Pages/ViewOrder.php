<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getReadyToReceiveAction()
        ];
    }


    public function getReadyToReceiveAction()
    {
        return Actions\Action::make('readyToReceive')
            ->label('Mark as Ready to Receive')
            ->icon(OrderStatus::ToReceive->getIcon())
            ->color(OrderStatus::ToReceive->getColor())
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->update(['status' => OrderStatus::ToReceive]);

                // [TODO] mail & notification for shipment
            })
            ->visible(fn($record) => $record->isToShip())
            ->closeModalByClickingAway(false);
    }
}
