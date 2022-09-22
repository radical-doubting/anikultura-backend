<?php

namespace App\Actions\Authentication\Api;

use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginFarmer
{
    use AsAction;

    public function handle(string $username, string $password): ?array
    {
        // Match request body with User model attributes
        $token = auth('api')->attempt([
            'name' => $username,
            'password' => $password,
        ]);

        if (! $token) {
            return null;
        }

        return CreateFarmerAuthPayload::run($token);
    }

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     description="Login to acquire an authentication token",
     *     tags={"auth"},
     *     @OA\RequestBody(
     *       required=true,
     *       description="Pass user credentials",
     *       @OA\JsonContent(
     *          required={"email","password"},
     *          @OA\Property(property="username", type="string", format="string", example="user1"),
     *          @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       ),
     *     ),
     *     @OA\Response(response="200", description="Successful login with returned authentication token", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Validation errors occured", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Invalid login credentials", @OA\JsonContent()),
     *     @OA\Response(response="400", description="Already logged in", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        if (auth('api')->user()) {
            return response()->json(['message' => 'Already logged in'], 400);
        }

        $username = $request->get('username');
        $password = $request->get('password');

        $authPayload = $this->handle($username, $password);

        if (is_null($authPayload)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $authCookie = cookie('token', $authPayload['accessToken'], $authPayload['expiresIn']);

        return response()->json($authPayload)->withCookie($authCookie);
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }
}
