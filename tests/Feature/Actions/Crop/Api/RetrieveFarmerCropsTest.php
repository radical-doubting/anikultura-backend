<?php

use App\Http\Resources\Crop\CropResource;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Models\Crop\Crop;
use App\Models\Farmer\Farmer;
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

it('should retrieve no crops if there is no seed allocation', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.crops'));

    $resource = CropResource::collection([]);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});

it('should retrieve crops if there is seed allocation', function () {
    $farmer = Farmer::first();
    $batch = Batch::first();
    $crop = Crop::first();

    BatchSeedAllocation::factory()->create([
        'batch_id' => $batch,
        'farmer_id' => $farmer,
        'crop_id' => $crop,
    ]);

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.crops'));

    $resource = CropResource::collection([$crop]);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});
