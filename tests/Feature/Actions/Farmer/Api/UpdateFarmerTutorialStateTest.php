<?php

use App\Models\User\Farmer\Farmer;
use App\Models\User\Farmer\FarmerPreference;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('updates tutorial state', function () {
    /**
     * @var Farmer
     */
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->patchJson(route('api.tutorial.update'), [
            'tutorialDone' => true,
        ]);

    $response
        ->assertJson([
            'message' => 'Successfully updated tutorial state',
        ])
        ->assertStatus(200);

    /**
     * @var FarmerPreference
     */
    $preference = $farmer->profile->preference;

    expect($preference->tutorial_done)->toBe(true);
});
