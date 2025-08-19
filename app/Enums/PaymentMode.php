<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasColor;

enum PaymentMode: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case UNFILLED = 'unfilled';

    case COD = 'cod';

    case OnlinePayment = 'online_payment';

    case ManualPayment = 'manual_payment';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::UNFILLED => 'Unfilled',
            self::COD => 'Cash on Delivery',
            self::OnlinePayment => 'Online Payment',
            self::ManualPayment => 'Manual Payment',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::UNFILLED => 'gray',
            self::COD => 'primary',
            self::OnlinePayment => 'success',
            self::ManualPayment => 'warning',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::UNFILLED => 'phosphor-question-duotone',
            self::COD => 'phosphor-hand-coins-duotone',
            self::OnlinePayment => 'phosphor-cardholder-duotone',
            self::ManualPayment => 'phosphor-money-duotone',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::UNFILLED => 'Unfilled',
            self::COD => 'Pay on delivery',
            self::OnlinePayment => 'Pay online',
            self::ManualPayment => 'Pay at store counter',
        };
    }

    // casesWithout
    public static function casesWithout(PaymentMode ...$modes): array
    {
        return array_values(
            array_filter(self::cases(), fn($case) => !in_array($case, $modes, true))
        );
    }
}
