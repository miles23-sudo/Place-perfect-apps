<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use App\Enums\OrderPaymentMode;

class Payment extends Settings
{
    public bool $is_cod_enabled;

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
}
