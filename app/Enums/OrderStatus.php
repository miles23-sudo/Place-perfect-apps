<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasColor;

enum OrderStatus: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case ToPay = 'to_pay';
    case ToRetryPayment = 'to_retry_payment';
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
            self::ToRetryPayment => 'To Retry Payment',
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
            self::ToRetryPayment => 'warning',
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
            self::ToRetryPayment => 'ri-error-warning-line',
            self::ToShip => 'ri-truck-line',
            self::ToReceive => 'ri-loop-right-line',
            self::Completed => 'ri-truck-line',
            self::ReturnRefund => 'ri-verified-badge-line',
            self::Cancelled => 'ri-close-circle-line',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::ToPay => 'Payment is pending.',
            self::ToRetryPayment => 'Payment failed, please try again or contact support.',
            self::ToShip => 'Order is being prepared for shipment.',
            self::ToReceive => 'Order is out for delivery.',
            self::Completed => 'Order has been completed successfully.',
            self::ReturnRefund => 'Order has been returned and refunded.',
            self::Cancelled => 'Order has been cancelled.',
        };
    }
}
