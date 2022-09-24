<?php

use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('should return tutorial done', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson('/api/farmers/tutorial');

    $response
        ->assertJson([
            'isTutorialDone' => false,
        ])
        ->assertStatus(200);
});
