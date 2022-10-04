<?php

use App\Models\Batch\Batch;
use App\Models\User\Admin\Admin;
use App\Models\User\Farmer\Farmer;
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
    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.batches.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create batch')
        ->assertSee('Batch Information')
        ->assertSee('Batch Site')
        ->assertSee('Batch Farmers')
        ->assertSee('Save');
});

it('shows an existing batch from the edit screen', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batches.edit')
        ->parameters([$batch->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit batch')
        ->assertSee('Batch Information')
        ->assertSee('Seeds Allocation')
        ->assertSee('Batch Site')
        ->assertSee('Batch Farmers')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($batch->farmschool_name);
});

it('creates a batch from the create screen', function () {
    $screen = screen('platform.batches.create')
        ->actingAs(Admin::first());

    $batch = Batch::factory()->makeOne();

    $batchData = $batch->only(
        'farmschool_name',
        'region_id',
        'province_id',
        'municity_id',
        'barangay'
    );

    $randomFarmerId = Farmer::all()->random()->id;

    $screen
        ->method('save', [
            'batch' => [
                ...$batchData,
                'farmers' => [
                    $randomFarmerId,
                ],
            ],
        ])
        ->assertSee('Batch was saved successfully!');

    assertDatabaseHas('batches', $batchData);
    assertDatabaseHas('batch_farmers', [
        'farmer_id' => $randomFarmerId,
    ]);
});

it('deletes an existing batch from the edit screen', function () {
    $batch = Batch::factory()->createOne();

    $batchData = $batch->only(
        'farmschool_name',
        'region_id',
        'province_id',
        'municity_id',
        'barangay'
    );

    $screen = screen('platform.batches.edit')
        ->parameters([$batch->id])
        ->actingAs(Admin::first());

    $screen
        ->method('removeBatch')
        ->assertSee('Batch was removed successfully!');

    assertDatabaseMissing('batches', $batchData);
});
