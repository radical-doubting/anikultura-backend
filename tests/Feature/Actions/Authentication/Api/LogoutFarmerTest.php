<?php

use App\Models\Farmer\Farmer;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;
use function Pest\Laravel\seed;
use function Pest\Laravel\withCookie;
use function Pest\Laravel\withCookies;
use function Pest\Laravel\withUnencryptedCookies;

beforeEach(function () {
    seed();
});

it('should logout farmer', function () {
    $farmer = Farmer::first();

    auth('api')->attempt([
        'name' => $farmer->name,
        'password' => 'password',
    ]);

    $response = postJson('/api/auth/logout');

    $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Successfully logged out',
        ]);
});

it('should not logout unauthenticated farmer', function () {
    $response = postJson('/api/auth/logout');

    $response
        ->assertStatus(401)
        ->assertJson([
            'message' => 'Unauthenticated.',
        ]);
});
