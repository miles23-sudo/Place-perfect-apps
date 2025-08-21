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

    public function getShippingFee(): float
    {
        if ($this->is_shipping_enable) {
            $distance = $this->getDistanceInKilometer();

            return $this->getDistanceFee($distance);
        }

        return 0;
    }

    private function getDistanceFee($distance): float
    {
        foreach ($this->distance_fee as $fee) {
            $first_distance = (int) explode('-', $fee['distance_range'])[0];
            $second_distance = (int) explode('-', $fee['distance_range'])[1];

            if ($distance >= $first_distance && $distance <= $second_distance) {
                return $fee['fee'];
            }
        }

        return 0;
    }

    private function getDistanceInKilometer(): float
    {
        $store_latitude = app(Contact::class)->latitude ?? 0;
        $store_longitude = app(Contact::class)->longitude ?? 0;
        $customer_latitude = auth('customer')->user()->customerAddress->latitude ?? 0;
        $customer_longitude = auth('customer')->user()->customerAddress->longitude ?? 0;

        return Haversine::calculateDistance($store_latitude, $store_longitude, $customer_latitude, $customer_longitude);
    }
}
