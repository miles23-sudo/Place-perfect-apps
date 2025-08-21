<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('contact.phone_numbers', [
            'primary' => '',
            'secondary' => '',
        ]);
        $this->migrator->add('contact.emails', [
            'primary' => '',
            'secondary' => '',
        ]);
        $this->migrator->add('contact.address', '');
        $this->migrator->add('contact.latitude', '');
        $this->migrator->add('contact.longitude', '');

        $this->migrator->add('contact.social_media_links', [
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
        ]);
    }
};
