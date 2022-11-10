<?php

use App\Models\Site\Province;
use Database\Seeders\Site\ProvinceSeeder;
use Database\Seeders\Site\RegionSeeder;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RegionSeeder::class,
        ProvinceSeeder::class,
    ]);
});

it('exports metrics', function () {
    $province = Province::first();
    $region = $province->region;
    $provinceCount = Province::ofRegion($region)->count();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('province_total')
        ->assertSee($region->slug)
        ->assertSee($provinceCount);
});
