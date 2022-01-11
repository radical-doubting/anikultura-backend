<?php

namespace App\Actions\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class LogoutFarmer
{
    use AsAction;

    public function handle()
    {
        auth('api')->logout();
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     description="Logout from current authenticated session",
     *     tags={"auth"},
     *     @OA\Tag(
     *       name="auth",
     *       description="Authentication endpoints"
     *     ),
     *     @OA\Response(response="200", description="Successful logout", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $this->handle();

        return response()
            ->json(['message' => 'Successfully logged out'])
            ->withCookie(Cookie::forget('token'));
    }
}
