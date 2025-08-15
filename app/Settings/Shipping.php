<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class Shipping extends Settings
{
    public bool $is_shipping_enable;
    public array $distance_fee;
    public string $delivery_terms;

    public static function group(): string
    {
        return 'shipping';
    }
}
