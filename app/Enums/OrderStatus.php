<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasColor;

enum OrderStatus: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case ToPay = 'to_pay';
    case ToShip = 'to_ship';
    case ToReceive = 'to_receive';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
    case Declined = 'declined';
    case ReturnRefund = 'return_refund';
    case ReturnRefundCompleted = 'return_refund_completed';
    case ReturnRefundDeclined = 'return_refund_declined';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ToPay => 'To Pay',
            self::ToShip => 'To Ship',
            self::ToReceive => 'To Receive',
            self::Delivered => 'Delivered',
            self::Cancelled => 'Cancelled',
            self::Declined => 'Declined',
            self::ReturnRefund => 'Return/Refund',
            self::ReturnRefundCompleted => 'Return/Refund Completed',
            self::ReturnRefundDeclined => 'Return/Refund Declined',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ToPay => 'primary',
            self::ToShip => 'success',
            self::ToReceive => 'warning',
            self::Delivered => 'info',
            self::Cancelled => 'gray',
            self::Declined  => 'gray',
            self::ReturnRefund => 'danger',
            self::ReturnRefundCompleted => 'info',
            self::ReturnRefundDeclined => 'gray',
        };
    }

    public function getColorPlain(): string
    {
        return match ($this) {
            self::ToPay => 'brown',
            self::ToShip => 'green',
            self::ToReceive => 'orange',
            self::Delivered => 'blue',
            self::Cancelled => 'gray',
            self::Declined  => 'gray',
            self::ReturnRefund => 'red',
            self::ReturnRefundCompleted => 'blue',
            self::ReturnRefundDeclined => 'gray',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::ToPay => 'phosphor-hand-coins-duotone',
            self::ToShip => 'phosphor-truck-duotone',
            self::ToReceive => 'phosphor-gift-duotone',
            self::Delivered => 'phosphor-check-circle-duotone',
            self::Cancelled => 'phosphor-x-circle-duotone',
            self::Declined => 'phosphor-prohibit-duotone',
            self::ReturnRefund => 'phosphor-arrows-left-right-duotone',
            self::ReturnRefundCompleted => 'phosphor-check-circle-duotone',
            self::ReturnRefundDeclined => 'phosphor-x-circle-duotone',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::ToPay => 'Awaiting payment.',
            self::ToShip => 'Preparing for shipment.',
            self::ToReceive => 'In transit.',
            self::Delivered => 'Successfully delivered.',
            self::Cancelled => 'Cancelled by customer.',
            self::Declined => 'Order declined.',
            self::ReturnRefund => 'Return requested.',
            self::ReturnRefundCompleted => 'Refund issued.',
            self::ReturnRefundDeclined => 'Return rejected.',
        };
    }
}
