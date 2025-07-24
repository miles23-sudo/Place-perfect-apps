<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('shopSetting.phone_numbers', [
            'primary' => '',
            'secondary' => '',
        ]);
        $this->migrator->add('shopSetting.emails', [
            'primary' => '',
            'secondary' => '',
        ]);
        $this->migrator->add('shopSetting.address', '');
        $this->migrator->add('shopSetting.google_map_iframe', '');
        $this->migrator->add('shopSetting.social_media_links', [
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
        ]);
    }
};
