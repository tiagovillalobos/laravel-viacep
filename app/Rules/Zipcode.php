<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Zipcode implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match(pattern: '/^[0-9]{5}-[0-9]{3}$/', subject: $value)) {
            $fail(
                __('O :attribute deve estar no formato 00000-000.'),
                ['zipcode' => $attribute]
            );
        }
    }
}
