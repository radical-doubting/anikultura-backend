<?php

namespace App\Actions\Authentication;

use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class HashPassword
{
    use AsAction;

    public function handle(string $plainTextPassword): string
    {
        return Hash::make($plainTextPassword);
    }
}
