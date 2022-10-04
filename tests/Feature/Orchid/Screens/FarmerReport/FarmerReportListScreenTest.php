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

it('shows list screen', function () {
    $screen = screen('platform.farmer-reports')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Farmer Report');
});

it('shows farmer report in list screen', function () {
    $farmerReport = FarmerReport::factory()->createOne([
        'reported_by' => Farmer::first()->id,
    ]);

    $screen = screen('platform.farmer-reports')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($farmerReport->farmer->first_name)
        ->assertSee($farmerReport->seedStage->name)
        ->assertSee($farmerReport->crop->name);
});
