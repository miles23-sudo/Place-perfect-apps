<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum OrderPaymentMethod: string implements HasLabel, HasColor, HasIcon
{
    case Card = 'card';
    case GCash = 'gcash';
    case Paymaya = 'paymaya';
    case CashOnDelivery = 'cod';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Card => 'Card',
            self::GCash => 'GCash',
            self::Paymaya => 'Paymaya',
            self::CashOnDelivery => 'Cash on Delivery',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Card => 'primary',
            self::GCash => 'info',
            self::Paymaya => 'success',
            self::CashOnDelivery => 'danger',
        };
    }

    public function getIcon(): string
    {
        return 'ri-wallet-3-line';
    }

    // get all online payment methods
    public static function getOnlineMethods(): array
    {
        return [
            self::Card->value,
            self::GCash->value,
            self::Paymaya->value,
        ];
    }
}
