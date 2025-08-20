<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;
use Filament\Actions;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Filament\Resources\OrderResource;
use App\Enums\OrderStatus;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getPrintReceipt(),
            $this->getDeclinedAction(),
            $this->getToShipAction(),
            $this->getToReceiveAction(),
        ];
    }

    public function getToReceiveAction()
    {
        return Actions\Action::make('toReceive')
            ->label('Mark as To Receive')
            ->icon(OrderStatus::ToReceive->getIcon())
            ->color(OrderStatus::ToReceive->getColor())
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->update(['status' => OrderStatus::ToReceive]);

                // [TODO] mail & notification for shipment
            })
            ->visible(fn($record) => $record->isToShip());
    }

    public function getToShipAction()
    {
        return Actions\Action::make('toShip')
            ->label('Mark as To Ship')
            ->icon(OrderStatus::ToShip->getIcon())
            ->color(OrderStatus::ToShip->getColor())
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->update(['status' => OrderStatus::ToShip]);

                // [TODO] mail & notification for shipment
            })
            ->visible(fn($record) => $record->isToPay() && $record->isCOD());
    }

    public function getDeclinedAction()
    {
        return Actions\Action::make('declined')
            ->label('Mark as Declined')
            ->icon(OrderStatus::Declined->getIcon())
            ->color(OrderStatus::Declined->getColor())
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->update(['status' => OrderStatus::Declined]);

                // [TODO] mail & notification for shipment
            })
            ->visible(fn($record) => $record->isToPay() && $record->isCOD());
    }

    // print receipt
    public function getPrintReceipt(): Actions\Action
    {
        return Actions\Action::make('printReceipt')
            ->label('Print Receipt')
            ->icon('phosphor-receipt-duotone')
            ->action(function ($record) {
                $pdf = Pdf::loadView('pdfs.order-receipt', compact('record'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true,
                        'defaultFont' => 'DejaVu Sans',
                        'dpi' => 150
                    ]);

                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, $record->order_number . '.pdf');
            })
            ->visible(fn($record) => $record->isToShip());
    }
}
