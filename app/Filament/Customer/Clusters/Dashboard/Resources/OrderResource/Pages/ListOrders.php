<?php

namespace App\Filament\Customer\Clusters\Dashboard\Resources\OrderResource\Pages;

use App\Filament\Customer\Clusters\Dashboard\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;
}
