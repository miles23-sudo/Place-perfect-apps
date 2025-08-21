<?php

namespace App\Services;

class Haversine
{
    const EARTH_RADIUS_KM = 6371;

    /**
     * Calculate the distance between two points on Earth using the Haversine formula
     *
     * @param float $latitude1 Latitude of the first point in decimal degrees
     * @param float $longitude1 Longitude of the first point in decimal degrees
     * @param float $latitude2 Latitude of the second point in decimal degrees
     * @param float $longitude2 Longitude of the second point in decimal degrees
     * @param string $unit Unit of measurement ('km', 'mi', 'm', 'nm')
     *                     - 'km' = kilometers (default)
     *                     - 'mi' = miles
     *                     - 'm' = meters
     *                     - 'nm' = nautical miles
     * @return float Distance between the two points in the specified unit
     */
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km', $precision = null)
    {
        // convert all to float
        $lat1 = (float) $lat1;
        $lon1 = (float) $lon1;
        $lat2 = (float) $lat2;
        $lon2 = (float) $lon2;

        // Haversine formula with radians conversion
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);

        $a = sin($dLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dLon / 2) ** 2;
        $distance = self::EARTH_RADIUS_KM * 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Unit conversion
        $multipliers = [
            'mi' => 0.621371,
            'miles' => 0.621371,
            'm' => 1000,
            'meters' => 1000,
            'nm' => 0.539957,
            'nautical' => 0.539957,
            'km' => 1,
            'kilometers' => 1
        ];

        $distance *= $multipliers[strtolower($unit)] ?? 1;

        // Handle precision
        return $precision === null ? round($distance) : round($distance, $precision);
    }
}
