<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use NumberFormatter;
use App\Services\Haversine;
use App\Models\Product;

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

    public function getDistanceFee($distance)
    {
        if (!$this->is_shipping_enable) {
            return 0;
        }

        foreach ($this->distance_fee as $fee) {
            $first_distance = (int) explode('-', $fee['distance_range'])[0];
            $second_distance = (int) explode('-', $fee['distance_range'])[1];

            if ($distance >= $first_distance && $distance <= $second_distance) {
                return number_format($fee['fee'], 2);
            }
        }

        return 0;
    }
}
