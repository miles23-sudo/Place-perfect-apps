<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Settings\Shipping;
use App\Settings\Contact;
use App\Services\Haversine;

class CustomerAddress extends Model
{
    protected $guarded = ['id'];

    protected $appends = [
        'location',
        'shipping_fee'
    ];

    // Relationships

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Returns the 'latitude' and 'longitude' attributes as the computed 'location' attribute,
     * as a standard Google Maps style Point array with 'lat' and 'lng' attributes.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @return array
     */

    public function getLocationAttribute(): array
    {
        return [
            "lat" => (float)$this->latitude,
            "lng" => (float)$this->longitude,
        ];
    }

    /**
     * Takes a Google style Point array of 'lat' and 'lng' values and assigns them to the
     * 'latitude' and 'longitude' attributes on this model.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @param ?array $location
     * @return void
     */
    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['latitude'] = $location['lat'];
            $this->attributes['longitude'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    /**
     * Get the lat and lng attribute/field names used on this table
     *
     * Used by the Filament Google Maps package.
     *
     * @return string[]
     */
    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

    /**
     * Get the name of the computed location attribute
     *
     * Used by the Filament Google Maps package.
     *
     * @return string
     */
    public static function getComputedLocation(): string
    {
        return 'location';
    }

    public function getShippingFeeAttribute()
    {
        if (filled(app(Contact::class)->address)) {
            $distance = Haversine::calculateDistance(
                $this->latitude,
                $this->longitude,
                app(Contact::class)->latitude,
                app(Contact::class)->longitude,
            );

            return app(Shipping::class)->getDistanceFee($distance);
        }

        return 0;
    }
}
