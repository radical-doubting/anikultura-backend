<?php

use App\Http\Resources\Batch\BatchSeedAllocationResource;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Models\Crop\Crop;
use App\Models\User\Farmer\Farmer;
use App\Models\Farmland\Farmland;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\Farmer\FarmerSeeder;
use Database\Seeders\Farmland\FarmlandStatusSeeder;
use Database\Seeders\Farmland\FarmlandTypeSeeder;
use Database\Seeders\Farmland\WateringSystemSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(SiteSeeder::class);
    seed(RoleSeeder::class);
    seed(FarmerSeeder::class);
    seed(AdminSeeder::class);
    seed(CropSeeder::class);
    seed(FarmlandTypeSeeder::class);
    seed(FarmlandStatusSeeder::class);
    seed(WateringSystemSeeder::class);

    $farmer = Farmer::first();

    $batch = Batch::factory()->create();
    $batch->farmers()->attach($farmer->id);

    $farmland = Farmland::factory()
        ->create([
            'batch_id' => $batch->id,
        ]);

    $farmland->farmers()->attach($farmer->id);
});

it('retrieves no seed allocations if actually none', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.seeds.allocation'));

    $resource = BatchSeedAllocationResource::collection([]);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});

it('retrieves seed allocations if actually has', function () {
    $farmer = Farmer::first();
    $batch = Batch::first();
    $crop = Crop::first();

    $batchSeedAllocation = BatchSeedAllocation::factory()->create([
        'batch_id' => $batch,
        'farmer_id' => $farmer,
        'crop_id' => $crop,
    ]);

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.seeds.allocation'));

    $resource = BatchSeedAllocationResource::collection([$batchSeedAllocation]);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});
