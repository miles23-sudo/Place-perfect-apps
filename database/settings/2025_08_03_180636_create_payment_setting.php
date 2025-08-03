<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment.methods', [
            [
                'channel' => 'e-wallet',
                'paymongo_id' => 'gcash',
                'label' => 'GCash',
                'is_enabled' => true,
            ],
            [
                'channel' => 'e-wallet',
                'paymongo_id' => 'maya',
                'label' => 'Maya',
                'is_enabled' => false,
            ],
            [
                'channel' => 'card',
                'paymongo_id' => 'card',
                'label' => 'Card/Bank',
                'is_enabled' => true,
            ],
        ]);
        $this->migrator->add('payment.is_cod_enabled', true);
    }
};
