<?php

namespace App\Actions\Authentication\Api;

use App\Http\Resources\Farmer\FarmerResource;
use Lorisleiva\Actions\Concerns\AsAction;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CreateFarmerAuthPayload
{
    use AsAction;

    public function handle(string $token): array
    {
        return [
            'accessToken' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => JWTAuth::factory()->getTTL() * 60,
            'user' => new FarmerResource(auth('api')->user()),
        ];
    }
}
