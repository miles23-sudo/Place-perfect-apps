<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class KeyValueUrlRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $values = array_values($value);

        foreach ($values as $value) {
            if ($value && !filter_var($value, FILTER_VALIDATE_URL) && !str_starts_with($value, 'https://')) {
                $fail(__('validation.url'));
            }
        }
    }
}
