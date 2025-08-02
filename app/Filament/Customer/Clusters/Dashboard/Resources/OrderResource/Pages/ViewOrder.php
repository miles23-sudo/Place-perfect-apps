<?php

namespace App\Filament\Customer\Clusters\Dashboard\Resources\OrderResource\Pages;

use App\Filament\Customer\Clusters\Dashboard\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Order Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('order_number')
                            ->label('Order Number'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Order Date & Time')
                            ->dateTime('F j, Y, g:i A'),
                        Infolists\Components\TextEntry::make('paid_at')
                            ->label('Paid Date & Time')
                            ->dateTime('F j, Y, g:i A'),
                        Infolists\Components\TextEntry::make('payment_method')
                            ->badge(),
                        Infolists\Components\TextEntry::make('overall_total')
                            ->label('Total Amount')
                            ->money('PHP', true)
                            ->extraAttributes([
                                'class' => 'text-2xl font-bold text-green-600 dark:text-green-400',
                            ]),
                        Infolists\Components\TextEntry::make('status')
                            ->badge(),
                    ])
                    ->columns(2),
            ]);
    }
}
