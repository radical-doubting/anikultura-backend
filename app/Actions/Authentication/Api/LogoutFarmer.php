<?php

namespace App\Actions\Authentication\Api;

use App\Traits\AsApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class LogoutFarmer
{
    use AsAction;
    use AsApiResponder;

    public function handle(): void
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

        return $this->respondWithSuccess('Successfully logged out')
            ->withCookie(Cookie::forget('token'));
    }
}
