<?php

namespace App\Actions\Authentication;

use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginFarmer
{
    use AsAction;

    public function handle($username, $password)
    {
        // Match request body with User model attributes
        $token = JWTAuth::attempt([
            'name' => $username,
            'password' => $password,
        ]);

        if (!$token) {
            return null;
        }

        return CreateAuthPayload::run($token);
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
     *     @OA\Response(response="401", description="Invalid login credentials", @OA\JsonContent())
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $authPayload = $this->handle($username, $password);

        if (!$authPayload) {
            return response()->json(['error' => 'Invalid login credentials'], 401);
        }

        return response()->json($authPayload);
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }
}
