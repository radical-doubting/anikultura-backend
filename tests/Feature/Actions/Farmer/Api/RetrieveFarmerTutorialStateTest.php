<?php

use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('returns tutorial done', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.tutorial'));

    $response
        ->assertExactJson(
            [
                'data' => [
                    'isTutorialDone' => false,
                ],
            ]
        )
        ->assertStatus(200);
});
