<?php

namespace App\Observers;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use Filament\Notifications\Notification;
use App\Models\User;
use App\Models\Order;
use Filament\Notifications\Actions\Action;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        Notification::make('orderCreated')
            ->title('New Order Placed')
            ->body('Check your orders page for more details.')
            ->icon(OrderStatus::ToPay->getIcon())
            ->color(OrderStatus::ToPay->getColor())
            ->actions([
                Action::make('viewOrder')
                    ->url(OrderResource::getUrl('view', ['record' => $order->id]))
            ])
            ->sendToDatabase(User::all());
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->wasChanged('status')) {
            Notification::make('orderStatusUpdated')
                ->title("Order #{$order->id}")
                ->body("Order status has been updated to {$order->status->name}.")
                ->icon($order->status->getIcon())
                ->color($order->status->getColor())
                ->actions([
                    Action::make('viewOrder')
                        ->url(OrderResource::getUrl('view', ['record' => $order->id]))
                ])
                ->sendToDatabase(User::all());
        }
    }
}
