<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class Payment extends Settings
{
    public array $methods;
    public bool $is_cod_enabled;

    const COD_LABEL = 'Cash on Delivery';

    const COD_ID = 'cod';

    public static function group(): string
    {
        return 'payment';
    }

    // get all channels
    public function getAllChannels(): array
    {
        return collect($this->methods)
            ->flatMap(fn($method) => [
                $method['channel'] => $method['channel']
            ])
            ->toArray();
    }

    // get all enabled methods & if cash on delivery is enabled only the keys
    public function getEnabledMethods(): array
    {
        return collect($this->methods)
            ->flatMap(fn($method) => $method['is_enabled'] ? [
                $method['paymongo_id'] => $method['label']
            ] : [])
            ->when($this->is_cod_enabled, function ($collection) {
                return $collection->merge([self::COD_ID => 'Cash on Delivery']);
            })
            ->toArray();
    }

    // get all paymongo IDs
    public function getAllPaymongoIds(): array
    {
        return collect($this->methods)
            ->map(fn($method) =>  $method['paymongo_id'])
            ->toArray();
    }

    // get labels
    public function getLabel(string $payment_id): ?string
    {
        if ($this->is_cod_enabled) {
            if ($payment_id === self::COD_ID) {
                return 'Cash on Delivery';
            }
        }

        return collect($this->methods)
            ->firstWhere('paymongo_id', $payment_id)['label'] ?? null;
    }



    // // get all enabled methods
    // public function getEnabledMethods(): array
    // {
    //     return collect($this->methods)
    //         ->flatMap(fn($method) => $method['is_enabled'] ? [
    //             $method['paymongo_id'] => $method['name']
    //         ] : [])
    //         ->toArray();
    // }
}
