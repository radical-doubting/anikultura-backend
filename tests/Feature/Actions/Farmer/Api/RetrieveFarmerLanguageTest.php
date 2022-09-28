<?php

use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('returns language preference', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.language'));

    $response
        ->assertExactJson([
            'data' => [
                'language' => 'en',
            ],
        ])
        ->assertStatus(200);
});
