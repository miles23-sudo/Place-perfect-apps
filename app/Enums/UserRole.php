<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum UserRole: string implements HasLabel, HasColor, HasIcon
{
    case Admin = 'admin';

    case Customer = 'customer';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Admin => 'danger',
            self::Customer => 'warning',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Admin => 'ri-shield-star-line',
            self::Customer => 'ri-user-circle-dashed-line',
        };
    }
}
