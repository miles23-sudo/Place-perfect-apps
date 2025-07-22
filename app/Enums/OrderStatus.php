<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum OrderStatus: string implements HasLabel, HasColor, HasIcon
{
    case Pending = 'pending';               // Order created, nothing done yet
    case AwaitingPayment = 'awaiting_payment'; // Waiting for PayMongo payment
    case Processing = 'processing';         // Payment done, preparing item
    case Shipped = 'shipped';               // Item in transit
    case Delivered = 'delivered';           // Item delivered
    case Cancelled = 'cancelled';           // Order cancelled

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Pending => 'primary',
            self::AwaitingPayment,
            self::Processing => 'warning',
            self::Shipped => 'info',
            self::Delivered => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Pending => 'ri-sparkling-line',
            self::AwaitingPayment,
            self::Processing => 'ri-loop-right-line',
            self::Shipped => 'ri-truck-line',
            self::Delivered => 'ri-verified-badge-line',
            self::Cancelled => 'ri-close-circle-line',
        };
    }
}
