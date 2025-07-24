<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class KeyValueStartsWithRule implements ValidationRule
{
    protected string $startsWith;

    public function __construct(string $startsWith)
    {
        $this->startsWith = $startsWith;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // for ref .. vendor\laravel\framework\src\Illuminate\Translation\lang\en\validation.php
        if (!is_array($value)) {
            $fail(__('validation.array', ['attribute' => $attribute]));
            return;
        }

        $values = array_values($value);

        foreach ($values as $value) {
            if ($value && !str_starts_with($value, $this->startsWith)) {
                $fail(__('validation.starts_with', ['values' => $this->startsWith]));
            }
        }
    }
}
