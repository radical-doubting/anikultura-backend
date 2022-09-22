<?php

use App\Models\Farmer\Farmer;
use App\Models\Farmer\FarmerPreference;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('should update tutorial state', function () {
    /**
     * @var Farmer
     */
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->patchJson('/api/farmers/tutorial', [
            'tutorialDone' => true,
        ]);

    $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Successfully updated tutorial state',
        ]);

    /**
     * @var FarmerPreference
     */
    $preference = $farmer->profile->preference;

    expect($preference->tutorial_done)->toBe(true);
});
