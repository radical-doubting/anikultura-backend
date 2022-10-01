<?php

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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\seed;

beforeEach(function () {
    Storage::fake();

    seed(SiteSeeder::class);
    seed(RoleSeeder::class);
    seed(FarmerSeeder::class);
    seed(AdminSeeder::class);
    seed(CropSeeder::class);
    seed(FarmlandTypeSeeder::class);
    seed(FarmlandStatusSeeder::class);
    seed(WateringSystemSeeder::class);
});

it('submits a farmer report', function () {
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
    $crop = Crop::first();
    $seedStage = SeedStage::initialStage();

    $response = actingAs($farmer, 'api')
        ->postJson(route('api.reports.submit'), [
            'image' => UploadedFile::fake()->image('crop.jpg'),
            'data' => json_encode([
                'farmlandId' => $farmland->id,
                'cropId' => Crop::first()->id,
                'volumeKg' => 10.23,
            ]),
        ]);

    $response
        ->assertJson([
            'data' => [
                'isVerified' => false,
                'crop' => [
                    'id' => $crop->id,
                    'name' => $crop->name,
                ],
                'seedStage' => [
                    'id' => $seedStage->id,
                    'name' => $seedStage->name,
                ],
            ],
        ])
        ->assertStatus(201);

    assertDatabaseCount('farmer_reports', 1);

    $farmerReport = FarmerReport::first();
    expect($farmerReport->reported_by)->toBe($farmer->id);
    expect($farmerReport->volume_kg)->toBe(10.23);
    expect($farmerReport->photo_url)->toContain('/storage/reports');
});

it('does not submit a farmer report to a non-belonging farmland', function () {
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

    $response = actingAs($farmer, 'api')
        ->postJson(route('api.reports.submit'), [
            'image' => UploadedFile::fake()->image('crop.jpg'),
            'data' => json_encode([
                'farmlandId' => $farmland->id,
                'cropId' => Crop::first()->id,
                'volumeKg' => 10.23,
            ]),
        ]);

    $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'Farmer does not belong to farmland',
        ]);

    assertDatabaseCount('farmer_reports', 0);
});
