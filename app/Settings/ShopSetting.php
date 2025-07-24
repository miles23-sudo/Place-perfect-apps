<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ShopSetting extends Settings
{
    public array $phone_numbers;
    public array $emails;
    public string $address;
    public string $google_map_iframe;
    public array $social_media_links;

    public static function group(): string
    {
        return 'shopSetting';
    }
}
