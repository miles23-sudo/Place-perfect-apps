<?php

namespace App\Providers\Filament;

use Filament\AvatarProviders\Contracts;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AvatarProvider implements Contracts\AvatarProvider
{
    public function get(Model|Authenticatable $record): string
    {
        return 'https://api.dicebear.com/9.x/shapes/svg?seed=' . strtok($record->name, ' ') . '&backgroundType=#ffffff&backgroundColor=ffffff&radius=50';
    }
}
