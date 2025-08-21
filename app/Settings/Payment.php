<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use App\Enums\PaymentMode;

class Payment extends Settings
{
    public array $methods;

    public bool $is_cod_enabled;

    public string $payment_terms;



    public static function group(): string
    {
        return 'payment';
    }

    // get all methods with their labels & descriptions
    public function getPaymentMethodChoices(): array
    {
        $choices = [];

        if (!empty($this->methods)) {
            $choices[PaymentMode::OnlinePayment->value] = [
                'label' => PaymentMode::OnlinePayment->getLabel(),
                'description' => PaymentMode::OnlinePayment->getDescription(),
            ];
        }

        if ($this->is_cod_enabled) {
            $choices[PaymentMode::COD->value] = [
                'label' => PaymentMode::COD->getLabel(),
                'description' => PaymentMode::COD->getDescription(),
            ];
        }

        // Available for admin panel only
        if (auth()->check()) {
            $choices[PaymentMode::ManualPayment->value] = [
                'label' => PaymentMode::ManualPayment->getLabel(),
                'description' => PaymentMode::ManualPayment->getDescription(),
            ];
        }

        return $choices;
    }

    // get the associative array
    public function getAssociativePaymentChoice()
    {
        return collect($this->getPaymentMethodChoices())
            ->mapWithKeys(fn($item, $key) => [
                $key => $item['label']
            ]);
    }

    // get all payment methods
    public function getPaymentMethodLabels(): array
    {
        $payment_methods = collect($this->methods)->map(fn($method) => $method['label'])->toArray();

        if ($this->is_cod_enabled) {
            $payment_methods[] = PaymentMode::COD->getLabel();
        }

        return $payment_methods;
    }

    // get all paymongo IDs
    public function getAllPaymongoIds(): array
    {
        return collect($this->methods)
            ->map(fn($method) =>  $method['paymongo_id'])
            ->toArray();
    }
}
