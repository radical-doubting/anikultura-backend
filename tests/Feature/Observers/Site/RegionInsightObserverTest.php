<?php

use App\Models\Site\Region;
use Database\Seeders\Site\RegionSeeder;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RegionSeeder::class,
    ]);
});

it('exports metrics', function () {
    $regionCount = Region::count();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('region_total')
        ->assertSee($regionCount);
});
