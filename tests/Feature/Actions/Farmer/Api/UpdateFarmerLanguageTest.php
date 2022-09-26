<?php

use App\Models\Farmer\Farmer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
});

it('should update language preference', function (string $language) {
    /**
     * @var Farmer
     */
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->patchJson(route('api.language.update'), [
            'language' => $language,
        ]);

    $response
        ->assertJson([
            'message' => 'Successfully updated language preference',
        ])
        ->assertStatus(200);

    expect($farmer->preferredLocale())->toBe($language);
})->with(['en', 'fil_PH', 'ceb']);
