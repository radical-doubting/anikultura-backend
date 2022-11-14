<?php

use App\Models\FarmerReport\FarmerReport;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\FarmerReport\FarmerReportStatusSeeder;
use Database\Seeders\Farmland\FarmlandSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        BigBrotherSeeder::class,
        SiteSeeder::class,
        FarmerSeeder::class,
        CropSeeder::class,
        BatchSeeder::class,
        FarmlandSeeder::class,
        FarmerReportStatusSeeder::class,
    ]);
});

it('shows list screen as admin', function () {
    $screen = screen('platform.farmer-reports')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Farmer Report');
});

it('shows list screen as big brother', function () {
    $screen = screen('platform.farmer-reports')->actingAs(BigBrother::first());

    $screen->display()
        ->assertSee('Farmer Report');
});

it('shows any farmer report in list screen as admin', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $screen = screen('platform.farmer-reports')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($farmerReport->farmer->first_name)
        ->assertSee($farmerReport->seedStage->name)
        ->assertSee($farmerReport->crop->name);
});

it('does not show any farmer report in list screen as big brother', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $screen = screen('platform.farmer-reports')->actingAs(BigBrother::first());

    $screen->display()
        ->assertDontSee($farmerReport->farmer->first_name)
        ->assertDontSee($farmerReport->seedStage->name)
        ->assertDontSee($farmerReport->crop->name);
});

it('shows belonging farmer report in list screen as big brother', function () {
    $bigBrother = BigBrother::first();

    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    /**
     * @var Batch
     */
    $batch = $farmerReport->farmland->batch;
    $batch->bigBrothers()->sync($bigBrother);

    $screen = screen('platform.farmer-reports')->actingAs($bigBrother);

    $screen->display()
        ->assertSee($farmerReport->farmer->first_name)
        ->assertSee($farmerReport->seedStage->name)
        ->assertSee($farmerReport->crop->name);
});
