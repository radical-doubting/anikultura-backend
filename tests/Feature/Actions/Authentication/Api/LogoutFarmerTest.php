<?php

use App\Models\Farmer\Farmer;
use function Pest\Laravel\postJson;
use function Pest\Laravel\seed;

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
