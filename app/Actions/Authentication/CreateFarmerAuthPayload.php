<?php

namespace App\Actions\Authentication;

use App\Http\Resources\Farmer\FarmerResource;
use Lorisleiva\Actions\Concerns\AsAction;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CreateFarmerAuthPayload
{
    use AsAction;

    public function handle($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => new FarmerResource(auth('api')->user()),
        ];
    }
}
