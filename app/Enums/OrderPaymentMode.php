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

    case Cash = 'cash';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::COD => 'Cash on Delivery',
            self::Online => 'Online Payment',
            self::Cash => 'Cash Payment',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::COD => 'primary',
            self::Online => 'success',
            self::Cash => 'warning',
        };
    }

    public function getColorHex(): string
    {
        return match ($this) {
            self::COD => '#BB976D',
            self::Online => '#198754',
            self::Cash => '#FFC107',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::COD => 'phosphor-hand-coins-duotone',
            self::Online => 'phosphor-globe-duotone',
            self::Cash => 'phosphor-cash-register-duotone',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::COD => 'Pay on Delivery',
            self::Online => 'Pay Online',
            self::Cash => 'Pay with Cash',
        };
    }

    // without payment proof
    public static function withoutThis(...$paymentModes)
    {
        return collect(self::cases())
            ->reject(fn($case) => in_array($case, $paymentModes, true))
            ->values();
    }
}
