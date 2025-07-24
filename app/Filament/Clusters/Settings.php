<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Settings extends Cluster
{
    protected static ?string $navigationIcon = 'ri-settings-line';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 2;
}
