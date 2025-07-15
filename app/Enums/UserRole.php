<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum UserRole: string implements HasLabel, HasColor, HasIcon
{
    case Admin = 'admin';
    case Dentist = 'dentist';
    case Receptionist = 'receptionist';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Admin => 'danger',
            self::Dentist => 'warning',
            self::Receptionist => 'success',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Admin => 'phosphor-shield-star-duotone',
            self::Dentist => 'phosphor-user-circle-dashed-duotone',
            self::Receptionist => 'phosphor-phone-duotone',
        };
    }
}
