<?php

use App\Http\Resources\Farmer\LanguageResource;
use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('should return language preference', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.language'));

    $resource = LanguageResource::make($farmer);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});
