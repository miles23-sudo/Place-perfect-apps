<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment.methods', [
            [
                'paymongo_id' => 'gcash',
                'label' => 'GCash',
            ],
            [
                'paymongo_id' => 'paymaya',
                'label' => 'Maya',
            ],
            [
                'paymongo_id' => 'card',
                'label' => 'Card/Bank',
            ],
        ]);

        $this->migrator->add('payment.is_cod_enabled', true);
    }
};
