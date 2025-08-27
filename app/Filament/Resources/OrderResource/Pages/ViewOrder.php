<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;
use Filament\Actions;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\Order\ToShipMail;
use App\Mail\Order\ToReceiveMail;
use App\Mail\Order\DeclinedMail;
use App\Filament\Resources\OrderResource\Widgets\CustomerAddressMap;
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

    public function getToShipAction()
    {
        return Actions\Action::make('toShip')
            ->label('Mark as To Ship')
            ->icon(OrderStatus::ToShip->getIcon())
            ->color(OrderStatus::ToShip->getColor())
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->update([
                    'status' => OrderStatus::ToShip,
                    'to_ship_at' => now()
                ]);
            })
            ->after(function ($record) {
                Mail::to($record->customer->email)->send(new ToShipMail($record));
            })
            ->visible(fn($record) => $record->isToPay());
    }

    public function getDeclinedAction()
    {
        return Actions\Action::make('declined')
            ->label('Mark as Declined')
            ->icon(OrderStatus::Declined->getIcon())
            ->color(OrderStatus::Declined->getColor())
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->update([
                    'status' => OrderStatus::Declined,
                    'declined_at' => now()
                ]);
            })
            ->after(function ($record) {
                Mail::to($record->customer->email)->send(new DeclinedMail($record));
            })
            ->visible(fn($record) => $record->isToPay());
    }

    public function getToReceiveAction()
    {
        return Actions\Action::make('toReceive')
            ->label('Mark as To Receive')
            ->icon(OrderStatus::ToReceive->getIcon())
            ->color(OrderStatus::ToReceive->getColor())
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->update([
                    'status' => OrderStatus::ToReceive,
                    'to_receive_at' => now()
                ]);
            })
            ->after(function ($record) {
                Mail::to($record->customer->email)->send(new ToReceiveMail($record));
            })
            ->visible(fn($record) => $record->isToShip());
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

                // open in new tab and close the tab again after download
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, $record->id . '.pdf');
            })
            ->visible(fn($record) => $record->isToReceive());
    }
}
