<?php

use App\Models\Farmland\Farmland;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\Farmland\FarmlandSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        SiteSeeder::class,
        FarmerSeeder::class,
        BatchSeeder::class,
        CropSeeder::class,
        FarmlandSeeder::class,
    ]);
});

it('exports metrics', function () {
    $farmland = Farmland::first();
    $region = $farmland->batch->region;
    $province = $farmland->batch->province;
    $municity = $farmland->batch->municity;

    $farmlandCount = Farmland::ofMunicity($municity)->count();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('farmland_total')
        ->assertSee($region->slug)
        ->assertSee($province->slug)
        ->assertSee($municity->slug)
        ->assertSee($farmlandCount);
});
