<?php

use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
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
    ]);
});

it('exports metrics', function () {
    $batch = Batch::first();

    $batchSeedAllocation = BatchSeedAllocation::factory()->createOne([
        'batch_id' => $batch->id,
        'farmer_id' => $batch->farmers->pluck('id')->first(),
    ]);

    $batch = $batchSeedAllocation->batch;
    $crop = $batchSeedAllocation->crop;

    $region = $batch->region;
    $province = $batch->province;
    $municity = $batch->municity;

    $batchSeedAllocationAmount = BatchSeedAllocation::ofBatch($batch)->sum('seed_amount');

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('batch_seed_allocation_total')
        ->assertSee($region->slug)
        ->assertSee($province->slug)
        ->assertSee($municity->slug)
        ->assertSee($crop->slug)
        ->assertSee($batchSeedAllocationAmount);
});
