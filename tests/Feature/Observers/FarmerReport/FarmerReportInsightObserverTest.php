<?php

use App\Models\Crop\SeedStage;
use App\Models\FarmerReport\FarmerReport;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\FarmerReport\FarmerReportSeeder;
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
        FarmerReportSeeder::class,
    ]);
});

it('exports census metrics', function () {
    $farmerReport = FarmerReport::first();

    $crop = $farmerReport->crop;
    $seedStage = $farmerReport->seedStage;
    $batch = $farmerReport->farmland->batch;

    $region = $batch->region;
    $province = $batch->province;
    $municity = $batch->municity;

    $farmerReportCount = FarmerReport::ofBatch($batch)->count();

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('farmer_report_total')
        ->assertSee($region->slug)
        ->assertSee($province->slug)
        ->assertSee($municity->slug)
        ->assertSee($crop->slug)
        ->assertSee($seedStage->slug)
        ->assertSee($farmerReportCount);
});

it('exports estimation metrics', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'seed_stage_id' => SeedStage::firstWhere('slug', 'seeds-planted'),
        'reported_by' => Farmer::first(),
    ]);

    $crop = $farmerReport->crop;
    $batch = $farmerReport->farmland->batch;
    $estimatedYieldAmount = $farmerReport->estimated_yield_amount * 1000;
    $estimatedYieldDateLower = date('m-Y', strtotime($farmerReport->estimated_yield_date_lower_bound));
    $estimatedYieldDateUpper = date('m-Y', strtotime($farmerReport->estimated_yield_date_upper_bound));

    $region = $batch->region;
    $province = $batch->province;
    $municity = $batch->municity;

    $response = get('/metrics');
    $response
        ->assertStatus(200)
        ->assertSee('farmer_report_estimated_yield_grams')
        ->assertSee($region->slug)
        ->assertSee($province->slug)
        ->assertSee($municity->slug)
        ->assertSee($crop->slug)
        ->assertSee($estimatedYieldAmount)
        ->assertSee($estimatedYieldDateLower)
        ->assertSee($estimatedYieldDateUpper);
});
