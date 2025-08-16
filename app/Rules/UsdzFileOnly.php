<?php

namespace App\Rules;

use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class UsdzFileOnly implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $extension = strtolower($value->getClientOriginalExtension());

        if ($extension !== 'usdz') {
            $fail("The $attribute must be a USDZ file.");
        }
    }
}
