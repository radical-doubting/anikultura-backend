<?php

use App\Models\Farmland\CropBuyer;
use App\Models\Farmland\Farmland;
use App\Models\Farmland\WateringSystem;
use App\Models\User\Admin\Admin;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\Farmland\FarmlandStatusSeeder;
use Database\Seeders\Farmland\FarmlandTypeSeeder;
use Database\Seeders\Farmland\WateringSystemSeeder;
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
        BatchSeeder::class,
        FarmlandTypeSeeder::class,
        FarmlandStatusSeeder::class,
        WateringSystemSeeder::class,
        CropSeeder::class,
    ]);
});

it('shows create farmland screen', function () {
    $screen = screen('platform.farmlands.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create Farmland')
        ->assertSee('Basic Information')
        ->assertSee('Farmers')
        ->assertSee('Other Information')
        ->assertSee('Save');
});

it('shows an existing farmland from the edit screen', function () {
    $farmland = Farmland::factory()->createOne();

    $screen = screen('platform.farmlands.edit')
        ->parameters([$farmland->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit Farmland')
        ->assertSee('Basic Information')
        ->assertSee('Farmers')
        ->assertSee('Other Information')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($farmland->name);
});

it('creates a farmland from the create screen', function () {
    $screen = screen('platform.farmlands.create')
        ->actingAs(Admin::first());

    $farmland = Farmland::factory()->makeOne();

    $farmlandData = $farmland->only(
        'name',
        'batch_id',
        'type_id',
        'status_id',
        'hectares_size',
    );

    $randomFarmerId = Farmer::all()->random()->id;
    $randomCropBuyerId = CropBuyer::all()->random()->id;
    $randomWateringSystemId = WateringSystem::all()->random()->id;

    $screen
        ->method('save', [
            'farmland' => [
                ...$farmlandData,
                'farmers' => [
                    $randomFarmerId,
                ],
                'cropBuyers' => [
                    $randomCropBuyerId,
                ],
                'wateringSystems' => [
                    $randomWateringSystemId,
                ],
            ],
        ])
        ->assertSee('Farmland was saved successfully!');

    assertDatabaseHas('farmlands', $farmlandData);
    assertDatabaseHas('farmland_farmers', [
        'farmer_id' => $randomFarmerId,
    ]);
    assertDatabaseHas('farmland_crop_buyers', [
        'crop_buyer_id' => $randomCropBuyerId,
    ]);
    assertDatabaseHas('farmland_watering_systems', [
        'watering_system_id' => $randomWateringSystemId,
    ]);
});

it('deletes an existing farmland from the edit screen', function () {
    $farmland = Farmland::factory()->createOne();

    $farmlandData = $farmland->only(
        'name',
        'batch_id',
        'type_id',
        'status_id',
        'hectares_size',
    );

    $screen = screen('platform.farmlands.edit')
        ->parameters([$farmland->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Farmland was removed successfully!');

    assertDatabaseMissing('farmlands', $farmlandData);
});
