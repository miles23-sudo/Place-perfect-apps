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
    case ReturnRefund = 'return_refund';
    case Cancelled = 'cancelled';
    case Declined = 'declined';

    public function getLabel(): ?string
    {
        // give space for the label from ToPay to To Pay
        return match ($this) {
            self::ToPay => 'To Pay',
            self::ToShip => 'To Ship',
            self::ToReceive => 'To Receive',
            self::Delivered => 'Delivered',
            self::ReturnRefund => 'Return/Refund',
            self::Cancelled => 'Cancelled',
            self::Declined => 'Declined'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ToPay => 'primary',
            self::ToShip => 'success',
            self::ToReceive => 'warning',
            self::Delivered => 'info',
            self::ReturnRefund => 'success',
            self::Cancelled,
            self::Declined => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::ToPay => 'phosphor-hand-coins-duotone',
            self::ToShip => 'phosphor-truck-duotone',
            self::ToReceive => 'phosphor-gift-duotone',
            self::Delivered => 'phosphor-check-circle-duotone',
            self::ReturnRefund => 'phosphor-arrows-clockwise-duotone',
            self::Cancelled,
            self::Declined => 'phosphor-prohibit-duotone',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::ToPay => 'Payment is pending.',
            self::ToShip => 'Order is being prepared for shipment.',
            self::ToReceive => 'Order is out for delivery.',
            self::Delivered => 'Order has been delivered successfully.',
            self::ReturnRefund => 'Order has been returned and refunded.',
            self::Cancelled => 'Order has been cancelled.',
            self::Declined => 'Order Request has been declined'
        };
    }
}
