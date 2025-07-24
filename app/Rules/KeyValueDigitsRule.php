<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class KeyValueDigitsRule implements ValidationRule
{
    protected int $digits;

    public function __construct(int $digits)
    {
        $this->digits = $digits;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail(__('validation.array', ['attribute' => $attribute]));
            return;
        }

        $values = array_values($value);

        foreach ($values as $value) {
            if ($value && strlen($value) !== $this->digits) {
                $fail(__('validation.digits', ['digits' => $this->digits]));
            }
        }
    }
}
