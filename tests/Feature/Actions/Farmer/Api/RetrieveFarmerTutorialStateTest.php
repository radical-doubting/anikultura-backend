<?php

use App\Http\Resources\Farmer\TutorialStateResource;
use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('should return tutorial done', function () {
    $farmer = Farmer::first();
    $farmerPreference = $farmer->profile->preference;

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.tutorial'));

    $resource = TutorialStateResource::make($farmerPreference);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});
