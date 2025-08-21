<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('shipping.is_shipping_enable', true);
        $this->migrator->add('shipping.distance_fee', [
            [
                'distance_range' => '0-1',
                'fee' => 100,
            ]
        ]);
        $this->migrator->add('shipping.delivery_terms', 'business delivery terms here');
    }
};
