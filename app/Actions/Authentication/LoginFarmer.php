<?php

namespace App\Actions\Authentication;

use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginFarmer
{
    use AsAction;

    public function handle($username, $password)
    {
        $token = auth()->attempt([
            'username' => $username,
            'password' => $password,
        ]);

        if (!$token) {
            return null;
        }

        return CreateAuthPayload::run($token);
    }

    public function asController(ActionRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $authPayload = $this->handle($username, $password);

        if (!$authPayload) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($authPayload);
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }
}
