<?php

use App\Http\Resources\FarmerReport\FarmerReportResource;
use App\Models\Batch\Batch;
use App\Models\Crop\Crop;
use App\Models\Crop\SeedStage;
use App\Models\FarmerReport\FarmerReport;
use App\Models\FarmerReport\FarmerReportStatus;
use App\Models\Farmland\Farmland;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\FarmerReport\FarmerReportStatusSeeder;
use Database\Seeders\Farmland\FarmlandStatusSeeder;
use Database\Seeders\Farmland\FarmlandTypeSeeder;
use Database\Seeders\Farmland\WateringSystemSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        SiteSeeder::class,
        RoleSeeder::class,
        FarmerSeeder::class,
        AdminSeeder::class,
        CropSeeder::class,
        FarmlandTypeSeeder::class,
        FarmlandStatusSeeder::class,
        WateringSystemSeeder::class,
        FarmerReportStatusSeeder::class,
    ]);

    /**
     * @var Farmer
     */
    $farmer = Farmer::first();

    /**
     * @var Batch
     */
    $batch = Batch::factory()->create();
    $batch->farmers()->attach($farmer->id);

    /**
     * @var Farmland
     */
    $farmland = Farmland::factory()
        ->create([
            'batch_id' => $batch->id,
        ]);

    $farmland->farmers()->attach($farmer->id);
});

it('retrieves submitted farmer reports', function () {
    /**
     * @var Farmer
     */
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

    $submittedFarmerReports = $farmer->farmerReports;

    $resource = FarmerReportResource::collection($submittedFarmerReports);

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.reports', [
            $farmland->id,
        ]));

    $response
        ->assertExactJson(
            $resource->response()->getData(true)
        )
        ->assertStatus(200);
});

it('retrieves submitted farmer reports with estimated metrics', function () {
    /**
     * @var Farmer
     */
    $farmer = Farmer::first();
    $farmland = Farmland::first();
    $seedStage = SeedStage::firstWhere('slug', 'seeds-planted');
    $crop = Crop::first();

    FarmerReport::factory()->create([
        'reported_by' => $farmer,
        'farmland_id' => $farmland,
        'seed_stage_id' => $seedStage,
        'crop_id' => $crop,
    ]);

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.reports', [
            $farmland->id,
        ]));

    $response
        ->assertJsonStructure([
            'data' => [
                [
                    'estimatedProfit',
                    'estimatedYieldAmount',
                    'estimatedYieldDateEarliest',
                    'estimatedYieldDateLatest',
                ],
            ],
        ])
        ->assertStatus(200);
});

it('retrieves submitted farmer reports with verifier', function () {
    /**
     * @var Farmer
     */
    $farmer = Farmer::first();
    $farmland = Farmland::first();
    $bigBrother = BigBrother::first();
    $seedStage = SeedStage::initialStage();
    $crop = Crop::first();

    FarmerReport::factory()->create([
        'reported_by' => $farmer,
        'status_id' => FarmerReportStatus::valid()->id,
        'verified_by' => $bigBrother,
        'farmland_id' => $farmland,
        'seed_stage_id' => $seedStage,
        'crop_id' => $crop,
    ]);

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.reports', [
            $farmland->id,
        ]));

    $response
        ->assertJson([
            'data' => [
                [
                    'isVerified' => true,
                ],
            ],
        ])
        ->assertJsonStructure([
            'data' => [
                [
                    'verifier',
                ],
            ],
        ])
        ->assertStatus(200);
});

it('retrieves submitted farmer reports with actual volume', function () {
    /**
     * @var Farmer
     */
    $farmer = Farmer::first();
    $farmland = Farmland::first();
    $seedStage = SeedStage::firstWhere('slug', 'crops-harvested');
    $crop = Crop::first();

    FarmerReport::factory()->create([
        'reported_by' => $farmer,
        'farmland_id' => $farmland,
        'seed_stage_id' => $seedStage,
        'crop_id' => $crop,
    ]);

    $response = actingAs($farmer, 'api')
        ->getJson(route('api.reports', [
            $farmland->id,
        ]));

    $response
        ->assertJsonStructure([
            'data' => [
                [
                    'actualVolumeKgProduced',
                ],
            ],
        ])
        ->assertStatus(200);
});
