<?php

namespace App\Settings;

use App\Models\Product;
use Spatie\LaravelSettings\Settings;
use NumberFormatter;

class Shipping extends Settings
{
    public bool $is_shipping_enable;
    public array $distance_fee;
    public string $delivery_terms;

    public static function group(): string
    {
        return 'shipping';
    }

    public function getDistanceFeeFormatted(): array
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

        return array_map(fn($fee) => [
            'distance_range' => $fee['distance_range'] . ' km',
            'fee' => $formatter->formatCurrency($fee['fee'], Product::CURRENCY)
        ], $this->distance_fee);
    }
}
