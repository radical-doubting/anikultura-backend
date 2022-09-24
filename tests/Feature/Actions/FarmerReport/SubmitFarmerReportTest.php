<?php

use App\Models\Batch\Batch;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
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
use function Pest\Laravel\assertDatabaseCount;
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
});

it('should submit a farmer report', function () {
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
        ->sequence(fn () => [
            'batch_id' => $batch->id,
        ])
        ->create();

    $farmland->farmers()->attach($farmer->id);

    $response = actingAs($farmer, 'api')
        ->postJson('/api/farmer-reports', [
            'farmerReport' => [
                'farmlandId' => $farmland->id,
                'cropId' => 1,
                'volumeKg' => 10.23,
            ],
        ]);

    $response
        ->assertJson([
            'isVerified' => false,
        ]);

    assertDatabaseCount('farmer_reports', 1);

    $farmerReport = FarmerReport::first();
    expect($farmerReport->reported_by)->toBe($farmer->id);
    expect($farmerReport->volume_kg)->toBe(10.23);
});

it('should not submit a farmer report to a non-belonging farmland', function () {
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
        ->sequence(fn () => [
            'batch_id' => $batch->id,
        ])
        ->create();

    $response = actingAs($farmer, 'api')
        ->postJson('/api/farmer-reports', [
            'farmerReport' => [
                'farmlandId' => $farmland->id,
                'cropId' => 1,
                'volumeKg' => 10.23,
            ],
        ]);

    $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'Farmer does not belong to farmland',
        ]);

    assertDatabaseCount('farmer_reports', 0);
});
