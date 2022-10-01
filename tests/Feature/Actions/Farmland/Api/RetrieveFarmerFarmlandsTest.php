<?php

use App\Http\Resources\Farmland\FarmlandResource;
use App\Models\Batch\Batch;
use App\Models\User\Farmer\Farmer;
use App\Models\Farmland\Farmland;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
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
});

it('retrieves no farmlands if actually has none', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.farmlands'));

    $resource = FarmlandResource::collection([]);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});

it('retrieves farmlands if actually has', function () {
    $farmer = Farmer::first();
    $batch = Batch::first();

    $farmland = Farmland::factory()
        ->create([
            'batch_id' => $batch->id,
        ]);

    $farmland->farmers()->attach($farmer->id);

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.farmlands'));

    $resource = FarmlandResource::collection([$farmland]);

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});
