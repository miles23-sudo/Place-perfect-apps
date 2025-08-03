<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RegionAddressExist implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the region exists in the PSGC data
        if (!in_array($value, collect(\Arxjei\PSGC::getRegions())->pluck('region_code')->toArray())) {
            $fail("The selected :attribute is invalid.");
        }
    }
}
