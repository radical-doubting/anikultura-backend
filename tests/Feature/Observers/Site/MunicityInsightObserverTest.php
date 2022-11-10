<?php

use App\Models\Site\Municity;
use Database\Seeders\Site\MunicitySeeder;
use Database\Seeders\Site\ProvinceSeeder;
use Database\Seeders\Site\RegionSeeder;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RegionSeeder::class,
        ProvinceSeeder::class,
        MunicitySeeder::class,
    ]);
});

it('exports metrics', function () {
    $municity = Municity::first();
    $region = $municity->region;
    $province = $municity->province;

    $municityCount = Municity::ofProvince($province)->count();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('province_total')
        ->assertSee($region->slug)
        ->assertSee($province->slug)
        ->assertSee($municityCount);
});
