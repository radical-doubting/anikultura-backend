<?php

use App\Models\Batch\Batch;
use App\Models\Crop\SeedStage;
use App\Models\FarmerReport\FarmerReport;
use App\Models\FarmerReport\FarmerReportStatus;
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
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
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

it('shows an existing farmer report from the edit screen as admin', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit farmer report')
        ->assertSee('Report Information')
        ->assertSee('Attachment Information')
        ->assertSee('Estimation Information')
        ->assertSee('Verification')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($farmerReport->farmer->first_name);
});

it('does not show non-belonging farmer report from the edit screen as big brother', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing farmer report from the edit screen as big brother', function () {
    $bigBrother = BigBrother::first();

    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    /**
     * @var Batch
     */
    $batch = $farmerReport->farmland->batch;
    $batch->bigBrothers()->sync($bigBrother);

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs($bigBrother);

    $screen->display()
        ->assertSee('Edit farmer report')
        ->assertSee('Report Information')
        ->assertSee('Attachment Information')
        ->assertSee('Estimation Information')
        ->assertSee('Verification')
        ->assertDontSee('Remove')
        ->assertSee('Save')
        ->assertSee($farmerReport->farmer->first_name);
});

it('shows seed planted stage farmer report with disclaimer from the edit screen as admin', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
        'seed_stage_id' => SeedStage::firstWhere('slug', 'seeds-planted')->id,
    ]);

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit farmer report')
        ->assertSee('Report Information')
        ->assertSee('Attachment Information')
        ->assertSee('Estimation Information')
        ->assertSee('Verification')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($farmerReport->farmer->first_name)
        ->assertSee('The estimated yield assuming');
});

it('shows seed planted stage farmer report with disclaimer from the edit screen as big brother', function () {
    $bigBrother = BigBrother::first();

    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
        'seed_stage_id' => SeedStage::firstWhere('slug', 'seeds-planted')->id,
    ]);

    /**
     * @var Batch
     */
    $batch = $farmerReport->farmland->batch;
    $batch->bigBrothers()->sync($bigBrother);

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs($bigBrother);

    $screen->display()
        ->assertSee('Edit farmer report')
        ->assertSee('Report Information')
        ->assertSee('Attachment Information')
        ->assertSee('Estimation Information')
        ->assertSee('Verification')
        ->assertDontSee('Remove')
        ->assertSee('Save')
        ->assertSee($farmerReport->farmer->first_name)
        ->assertSee('The estimated yield assuming');
});

it('verifies any farmer report from the edit screen as admin', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $farmerReportData = $farmerReport->only(
        'reported_by',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'volume_kg',
    );

    $farmerReportData['status_id'] = FarmerReportStatus::valid()->id;

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(Admin::first());

    $screen
        ->method(
            'save',
            [
                'farmerReport' => [
                    ...$farmerReportData,
                ],
            ]
        )
        ->assertSee('Farmer report was saved successfully!');

    assertDatabaseHas('farmer_reports', $farmerReportData);
});

it('does not verify any farmer report from the edit screen as big brother', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
        'status_id' => FarmerReportStatus::unverified()->id,
    ]);

    $farmerReportData = $farmerReport->only(
        'reported_by',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'volume_kg',
    );

    $farmerReportData['status_id'] = FarmerReportStatus::valid()->id;

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(BigBrother::first());

    $screen
        ->method(
            'save',
            [
                'farmerReport' => [
                    ...$farmerReportData,
                ],
            ]
        )
        ->assertDontSee('Farmer report was saved successfully!');

    assertDatabaseMissing('farmer_reports', $farmerReportData);
})->only();

it('verifies a belonging farmer report from the edit screen as big brother', function () {
    $bigBrother = BigBrother::first();

    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    /**
     * @var Batch
     */
    $batch = $farmerReport->farmland->batch;
    $batch->bigBrothers()->sync($bigBrother);

    $farmerReportData = $farmerReport->only(
        'reported_by',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'volume_kg',
    );

    $farmerReportData['status_id'] = FarmerReportStatus::valid()->id;

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs($bigBrother);

    $screen
        ->method(
            'save',
            [
                'farmerReport' => [
                    ...$farmerReportData,
                ],
            ]
        )
        ->assertSee('Farmer report was saved successfully!');

    assertDatabaseHas('farmer_reports', $farmerReportData);
});

it('deletes any farmer report from the edit screen as admin', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $farmerReportData = $farmerReport->only(
        'reported_by',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'volume_kg',
        'status_id',
    );

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Farmer report was removed successfully!');

    assertDatabaseMissing('farmer_reports', $farmerReportData);
});

it('does not delete any farmer report from the edit screen as big brother', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $farmerReportData = $farmerReport->only(
        'reported_by',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'volume_kg',
        'status_id',
    );

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(BigBrother::first());

    $screen
        ->method('remove')
        ->assertDontSee('Farmer report was removed successfully!');

    assertDatabaseHas('farmer_reports', $farmerReportData);
});
