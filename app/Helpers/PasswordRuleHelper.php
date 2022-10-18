<?php

namespace App\Helpers;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class PasswordRuleHelper
{
    public static function getRule(): Rule
    {
        return Password::min(8)
            ->letters()
            ->numbers()
            ->symbols()
            ->uncompromised();
    }
}
