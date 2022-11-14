<?php

use App\Models\Batch\Batch;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        SiteSeeder::class,
        FarmerSeeder::class,
        BatchSeeder::class,
    ]);
});

it('exports census metrics', function () {
    $batch = Batch::first();
    $region = $batch->region;
    $province = $batch->province;
    $municity = $batch->municity;

    $batchCount = Batch::ofMunicity($municity)->count();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('batch_total')
        ->assertSee($region->slug)
        ->assertSee($province->slug)
        ->assertSee($municity->slug)
        ->assertSee($batchCount);
});

it('exports farmer assignment metrics', function () {
    $batch = Batch::first();
    $region = $batch->region;
    $province = $batch->province;
    $municity = $batch->municity;

    $farmerAssignedCount = Farmer::ofBatch($batch)->count();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('farmer_total')
        ->assertSee($region->slug)
        ->assertSee($province->slug)
        ->assertSee($municity->slug)
        ->assertSee($farmerAssignedCount);
});
