<?php

use App\Events\ReadyForHarvestEvent;
use App\Models\Crop\SeedStage;
use App\Models\FarmerReport\FarmerReport;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\FarmerReport\FarmerReportStatusSeeder;
use Database\Seeders\Farmland\FarmlandSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use Illuminate\Support\Facades\Event;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        SiteSeeder::class,
        FarmerSeeder::class,
        BatchSeeder::class,
        CropSeeder::class,
        FarmlandSeeder::class,
        FarmerReportStatusSeeder::class,
    ]);

    Event::fake([
        ReadyForHarvestEvent::class,
    ]);
});

it('creates ready for harvest event', function () {
    FarmerReport::factory()->createOne([
        'seed_stage_id' => SeedStage::firstWhere('slug', 'crops-harvested'),
        'reported_by' => Farmer::first(),
    ]);

    Event::assertDispatched(ReadyForHarvestEvent::class);
});
