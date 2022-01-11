<?php

namespace App\Actions\Authentication;

use Lorisleiva\Actions\Concerns\AsAction;

class CreateAuthPayload
{
    use AsAction;

    public function handle($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ];
    }
}
