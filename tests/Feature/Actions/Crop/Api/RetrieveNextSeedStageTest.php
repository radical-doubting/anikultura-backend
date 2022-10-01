<?php

use App\Http\Resources\Crop\SeedStageResource;
use App\Models\Batch\Batch;
use App\Models\Crop\Crop;
use App\Models\Crop\SeedStage;
use App\Models\User\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Database\Seeders\User\Admin\AdminSeeder;
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

    $farmland = Farmland::factory()
        ->create([
            'batch_id' => $batch->id,
        ]);

    $farmland->farmers()->attach($farmer->id);
});

it('retrieves no next seed stage if at last stage', function () {
    $farmer = Farmer::first();
    $farmland = Farmland::first();
    $seedStage = SeedStage::firstWhere('slug', 'marketable');
    $crop = Crop::first();

    FarmerReport::factory()->create([
        'reported_by' => $farmer,
        'farmland_id' => $farmland,
        'seed_stage_id' => $seedStage,
        'crop_id' => $crop,
    ]);

    $response = actingAs($farmer, 'api')
        ->postJson(
            route('api.seeds.next-stage'),
            [
                'farmlandId' => $farmland->id,
            ]
        );

    $response
        ->assertExactJson([])
        ->assertStatus(200);
});

it('retrieves next seed stage if submitted a report', function () {
    $farmer = Farmer::first();
    $farmland = Farmland::first();
    $seedStage = SeedStage::initialStage();
    $crop = Crop::first();

    FarmerReport::factory()->create([
        'reported_by' => $farmer,
        'farmland_id' => $farmland,
        'seed_stage_id' => $seedStage,
        'crop_id' => $crop,
    ]);

    $response = actingAs($farmer, 'api')
        ->postJson(
            route('api.seeds.next-stage'),
            [
                'farmlandId' => $farmland->id,
            ]
        );

    $resource = SeedStageResource::make($seedStage->nextStage());

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});

it('retrieves next seed stage if no submitted a report', function () {
    $farmer = Farmer::first();
    $farmland = Farmland::first();

    $response = actingAs($farmer, 'api')
        ->postJson(
            route('api.seeds.next-stage'),
            [
                'farmlandId' => $farmland->id,
            ]
        );

    $resource = SeedStageResource::make(SeedStage::initialStage());

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});

it('returns error if retrieving seed stage from non-existent farmland', function () {
    $farmer = Farmer::first();

    $response = actingAs($farmer, 'api')
        ->postJson(
            route('api.seeds.next-stage'),
            [
                'farmlandId' => -1,
            ]
        );

    $response
        ->assertJson([
            'message' => 'The selected farmland id is invalid.',
        ])
        ->assertStatus(422);
});
