<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Filament\Actions;
use App\Models\Order;
use App\Filament\Resources\OrderResource;
use App\Enums\OrderStatus;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }



    protected function getHeaderWidgets(): array
    {
        return [
            OrderResource\Widgets\StatsOverview::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),

            'To Pay' => Tab::make()
                ->icon(OrderStatus::ToPay->getIcon())
                ->badge(Order::query()->toPay()->count())
                ->badgeColor(OrderStatus::ToPay->getColor())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereStatus(OrderStatus::ToPay->value)),

            'To Retry Payment' => Tab::make()
                ->icon(OrderStatus::ToRetryPayment->getIcon())
                ->badge(Order::query()->toRetryPayment()->count())
                ->badgeColor(OrderStatus::ToRetryPayment->getColor())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereStatus(OrderStatus::ToRetryPayment->value)),

            'To Ship' => Tab::make()
                ->icon(OrderStatus::ToShip->getIcon())
                ->badge(Order::query()->toShip()->count())
                ->badgeColor(OrderStatus::ToShip->getColor())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereStatus(OrderStatus::ToShip->value)),

            'To Receive' => Tab::make()
                ->icon(OrderStatus::ToReceive->getIcon())
                ->badge(Order::query()->toReceive()->count())
                ->badgeColor(OrderStatus::ToReceive->getColor())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereStatus(OrderStatus::ToReceive->value)),

            'Completed' => Tab::make()
                ->icon(OrderStatus::Completed->getIcon())
                ->badge(Order::query()->completed()->count())
                ->badgeColor(OrderStatus::Completed->getColor())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereStatus(OrderStatus::Completed->value)),

            'Return/Refund' => Tab::make()
                ->icon(OrderStatus::ReturnRefund->getIcon())
                ->badge(Order::query()->returnRefund()->count())
                ->badgeColor(OrderStatus::ReturnRefund->getColor())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereStatus(OrderStatus::ReturnRefund->value)),

            'Cancelled' => Tab::make()
                ->icon(OrderStatus::Cancelled->getIcon())
                ->badge(Order::query()->cancelled()->count())
                ->badgeColor(OrderStatus::Cancelled->getColor())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereStatus(OrderStatus::Cancelled->value)),

        ];
    }
}
