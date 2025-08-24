<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment.is_cod_enabled', true);
        $this->migrator->add('payment.payment_terms', 'business payment terms here');
    }
};
