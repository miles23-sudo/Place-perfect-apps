<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use App\Enums\PaymentMode;

class Payment extends Settings
{
    public bool $is_cod_enabled;

    public string $payment_terms;

    public static function group(): string
    {
        return 'payment';
    }
}
