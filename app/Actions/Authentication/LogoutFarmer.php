<?php

namespace App\Actions\Authentication;

use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class LogoutFarmer
{
    use AsAction;

    public function handle()
    {
        auth()->logout();
    }


    public function asController(ActionRequest $request)
    {
        $this->handle();
        return response()->json(['message' => 'User successfully signed out']);
    }
}
