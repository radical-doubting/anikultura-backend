<?php

use App\Models\FarmerReport\FarmerReport;
use App\Models\User\Admin\Admin;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\Farmland\FarmlandSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Admin\AdminProfileSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
        SiteSeeder::class,
        FarmerSeeder::class,
        CropSeeder::class,
        BatchSeeder::class,
        FarmlandSeeder::class,
    ]);
});

it('shows create farmer report screen', function () {
    $screen = screen('platform.farmer-reports.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create farmer report')
        ->assertSee('Report Information')
        ->assertSee('Attachment Information')
        ->assertSee('Estimation Information')
        ->assertSee('Verification')
        ->assertSee('Save');
});

it('shows an existing farmer report from the edit screen', function () {
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

it('creates a farmland from the create screen', function () {
    $screen = screen('platform.farmer-reports.create')
        ->actingAs(Admin::first());

    $farmerReport = FarmerReport::factory()->makeOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $farmerReportData = $farmerReport->only(
        'reported_by',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'volume_kg',
    );

    $screen
        ->method('save', [
            'farmerReport' => $farmerReportData,
        ])
        ->assertSee('Farmer report was saved successfully!');

    assertDatabaseHas('farmer_reports', $farmerReportData);
});

it('deletes an existing farmer report from the edit screen', function () {
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

    $screen = screen('platform.farmer-reports.edit')
        ->parameters([$farmerReport->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Farmer report was removed successfully!');

    assertDatabaseMissing('farmer_reports', $farmerReportData);
});
