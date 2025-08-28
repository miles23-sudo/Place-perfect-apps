<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use App\Enums\OrderPaymentMode;

class Payment extends Settings
{
    public array $online_channels;

    public string $payment_terms;

    public static function group(): string
    {
        return 'payment';
    }

    public function getCashOnDeliveryLabel(): string
    {
        return OrderPaymentMode::COD->getLabel();
    }

    public function getAssociativeArrayOfOnlineChannels(): array
    {
        return collect($this->online_channels)
            ->mapWithKeys(fn($channel) => [$channel['name'] => $channel['name']])
            ->toArray();
    }
}
