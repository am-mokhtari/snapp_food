<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(09|989|9|\+989)\d{9}/i', $value)){
            $fail('This :attribute is invalid.');
        }
    }
}
