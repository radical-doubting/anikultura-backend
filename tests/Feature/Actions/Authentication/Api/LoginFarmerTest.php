<?php

use App\Models\User\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('shows farmer', function () {
    $farmer = Farmer::first();

    $response = postJson(route('api.login'), [
        'username' => $farmer->name,
        'password' => 'password',
    ]);

    $response
        ->assertJson([
            'tokenType' => 'bearer',
            'expiresIn' => 3600,
        ])
        ->assertCookie('token')
        ->assertStatus(200);
});

it('does not login a farmer with wrong password', function () {
    $farmer = Farmer::first();

    $response = postJson('/api/auth/login', [
        'username' => $farmer->name,
        'password' => 'wrongpassword',
    ]);

    $response
        ->assertJson([
            'message' => 'Invalid login credentials',
        ])
        ->assertStatus(401);
});

it('does not login a non-existent farmer', function () {
    $response = postJson('/api/auth/login', [
        'username' => 'nonexistentfarmeruser',
        'password' => 'password',
    ]);

    $response
        ->assertJson([
            'message' => 'Invalid login credentials',
        ])
        ->assertStatus(401);
});

it('does not login an already logged in farmer', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->postJson('/api/auth/login', [
            'username' => $farmer->name,
            'password' => 'password',
        ]);

    $response
        ->assertJson([
            'message' => 'Already logged in',
        ])
        ->assertStatus(400);
});
