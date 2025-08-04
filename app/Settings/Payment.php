<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class Payment extends Settings
{
    public array $methods;
    public bool $is_cod_enabled;

    const COD_LABEL = 'Cash on Delivery';

    const ONLINE_PAYMENT_LABEL = 'Online Payment';

    const COD_ID = 'cod';

    const ONLINE_PAYMENT_ID = 'online_payment';



    public static function group(): string
    {
        return 'payment';
    }

    // group methods by online payment and cash on delivery
    public function getMethodsByChannel(): array
    {
        return collect($this->methods)
            ->groupBy(fn($method) => $method['paymongo_id'] === self::COD_ID ? 'cod' : self::ONLINE_PAYMENT_ID)
            ->map(fn($methods, $channel) => $methods->pluck('label')->toArray())
            ->when($this->is_cod_enabled, function ($collection) {
                return $collection->merge([self::COD_ID => [self::COD_LABEL]]);
            })
            ->toArray();
    }

    // get all methods with their labels & descriptions
    public function getPaymentMethodChoices(): array
    {
        $methods = collect($this->methods);

        return collect()
            ->when($methods->isNotEmpty(), function ($collection) use ($methods) {
                return $collection->put(self::ONLINE_PAYMENT_ID, [
                    'label' => self::ONLINE_PAYMENT_LABEL,
                    'description' => 'Pay Online with ' . $methods->pluck('label')->implode(', '),
                ]);
            })
            ->when($this->is_cod_enabled, function ($collection) {
                return $collection->put(self::COD_ID, [
                    'label' => self::COD_LABEL,
                    'description' => 'Pay when you receive the product',
                ]);
            })
            ->toArray();
    }



    // get all enabled methods & if cash on delivery is enabled only the keys
    public function getAllEnabledMethods(): array
    {
        return collect($this->methods)
            ->flatMap(fn($method) => [$method['paymongo_id'] => $method['label']])
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
}
