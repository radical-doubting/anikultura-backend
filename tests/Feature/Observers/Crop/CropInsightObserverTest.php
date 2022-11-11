<?php

use App\Models\Crop\Crop;
use function Pest\Laravel\get;

it('exports metrics', function () {
    $crop = Crop::factory()->createOne();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('crop_net_profit_cost_ratio')
        ->assertSee('crop_profit_per_kg_pesos')
        ->assertSee($crop->slug)
        ->assertSee($crop->profit_per_kg)
        ->assertSee($crop->net_profit_cost_ratio);
});
