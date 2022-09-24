<?php

use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('should return language preference', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson('/api/farmers/language');

    $response
        ->assertJson([
            'language' => 'en',
        ])
        ->assertStatus(200);
});
