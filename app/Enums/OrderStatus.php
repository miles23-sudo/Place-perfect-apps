<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum OrderStatus: string implements HasLabel, HasColor, HasIcon
{
    case ToPay = 'to_pay';
    case ToShip = 'to_ship';
    case ToReceive = 'to_receive';
    case Completed = 'completed';
    case ReturnRefund = 'return_refund';
    case Cancelled = 'cancelled';

    public function getLabel(): ?string
    {
        // give space for the label from ToPay to To Pay
        return match ($this) {
            self::ToPay => 'To Pay',
            self::ToShip => 'To Ship',
            self::ToReceive => 'To Receive',
            self::Completed => 'Completed',
            self::ReturnRefund => 'Return/Refund',
            self::Cancelled => 'Cancelled',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ToPay => 'primary',
            self::ToShip => 'success',
            self::ToReceive => 'warning',
            self::Completed => 'info',
            self::ReturnRefund => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::ToPay => 'ri-time-line',
            self::ToShip => 'ri-truck-line',
            self::ToReceive => 'ri-loop-right-line',
            self::Completed => 'ri-truck-line',
            self::ReturnRefund => 'ri-verified-badge-line',
            self::Cancelled => 'ri-close-circle-line',
        };
    }
}
