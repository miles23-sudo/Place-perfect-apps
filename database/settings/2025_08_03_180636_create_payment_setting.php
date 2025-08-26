<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment.online_channels', [
            [
                'logo' => null,
                'name' => 'Gcash',
                'account_number' => '09123456789',
            ],
            [
                'logo' => null,
                'name' => 'Maya',
                'account_number' => '09123456789',
            ]
        ]);
        $this->migrator->add('payment.payment_terms', 'business payment terms here');
    }
};
