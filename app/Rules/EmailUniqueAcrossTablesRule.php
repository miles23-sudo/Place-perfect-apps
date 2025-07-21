<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use App\Models\User;
use App\Models\Customer;

class EmailUniqueAcrossTablesRule implements ValidationRule
{
    protected $record;

    public function __construct($record = null)
    {
        $this->record = $record;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user_email_exists = User::where('email', $value)
            ->when($this->record, fn($query) => $query->where('id', '!=', $this->record->id))->exists();

        $customer_email_exists = Customer::where('email', $value)
            ->when($this->record, fn($query) => $query->where('id', '!=', $this->record->id))
            ->exists();

        if ($user_email_exists || $customer_email_exists) {
            $fail('The email has already been taken.');
        }
    }
}
