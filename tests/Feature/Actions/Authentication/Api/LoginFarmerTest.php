<?php

use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('should login farmer', function () {
    $farmer = Farmer::first();

    $response = postJson('/api/auth/login', [
        'username' => $farmer->name,
        'password' => 'password',
    ]);

    $response
        ->assertStatus(200)
        ->assertCookie('token')
        ->assertJson([
            'tokenType' => 'bearer',
            'expiresIn' => 3600,
        ]);
});

it('should not login a farmer with wrong password', function () {
    $farmer = Farmer::first();

    $response = postJson('/api/auth/login', [
        'username' => $farmer->name,
        'password' => 'wrongpassword',
    ]);

    $response
        ->assertStatus(401)
        ->assertJson([
            'message' => 'Invalid login credentials',
        ]);
});

it('should not login a non-existent farmer', function () {
    $response = postJson('/api/auth/login', [
        'username' => 'nonexistentfarmeruser',
        'password' => 'password',
    ]);

    $response
        ->assertStatus(401)
        ->assertJson([
            'message' => 'Invalid login credentials',
        ]);
});

it('should not login an already logged in farmer', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->postJson('/api/auth/login', [
            'username' => $farmer->name,
            'password' => 'password',
        ]);

    $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'Already logged in',
        ]);
});
