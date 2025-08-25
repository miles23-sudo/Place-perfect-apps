<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasColor;

enum OrderPaymentMode: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case COD = 'cod';
    case Online = 'online';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::COD => 'Cash on Delivery',
            self::Online => 'Online Payment',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::COD => 'primary',
            self::Online => 'success',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::COD => 'phosphor-hand-coins-duotone',
            self::Online => 'phosphor-globe-duotone',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::COD => 'Pay on Delivery',
            self::Online => 'Pay Online',
        };
    }
}
