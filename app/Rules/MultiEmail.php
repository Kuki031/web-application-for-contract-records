<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MultiEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emails = explode(';', $value);

        foreach ($emails as $email) {
            $email = trim($email);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $fail(":attribute polje sadrži neispravnu e-mail adresu: {$email}");
                return;
            }
        }
    }
}

