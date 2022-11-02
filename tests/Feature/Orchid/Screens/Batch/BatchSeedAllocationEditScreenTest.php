<?php

use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Models\User\Admin\Admin;
use Database\Seeders\Crop\CropSeeder;
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
    ]);
});

it('shows create batch seed allocation screen', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batch-seed-allocations.create')
        ->parameters([$batch->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create batch seed allocation')
        ->assertSee('Allocation Information')
        ->assertSee('Save');
});

it('shows an existing batch seed allocation from the edit screen', function () {
    $batch = Batch::factory()->createOne();
    $batchSeedAllocation = BatchSeedAllocation::factory()
        ->createOne([
            'batch_id' => $batch->id,
        ]);

    $screen = screen('platform.batch-seed-allocations.edit')
        ->parameters([
            $batch->id,
            $batchSeedAllocation->id,
        ])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit batch seed allocation')
        ->assertSee('Allocation Information')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($batchSeedAllocation->farmer->first_name)
        ->assertSee($batchSeedAllocation->farmer->last_name)
        ->assertSee($batchSeedAllocation->crop->name)
        ->assertSee($batchSeedAllocation->seed_amount);
});

it('creates a batch seed allocation from the create screen', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batch-seed-allocations.create')
        ->parameters([
            $batch->id,
        ])
        ->actingAs(Admin::first());

    $batchSeedAllocation = BatchSeedAllocation::factory()
        ->makeOne([
            'batch_id' => $batch->id,
        ]);

    $batchSeedAllocationData = $batchSeedAllocation->only(
        'farmer_id',
        'seed_amount',
        'crop_id',
    );

    $screen
        ->method('save', [
            'batchSeedAllocation' => $batchSeedAllocationData,
        ])
        ->assertSee('Batch seed allocation was saved successfully!');

    assertDatabaseHas('batch_seed_allocations', $batchSeedAllocationData);
});

it('deletes an batch region from the edit screen', function () {
    $batch = Batch::factory()->createOne();

    $batchSeedAllocation = BatchSeedAllocation::factory()
        ->createOne([
            'batch_id' => $batch->id,
        ]);

    $batchSeedAllocationData = $batchSeedAllocation->only(
        'farmer_id',
        'seed_amount',
        'crop_id',
    );

    $screen = screen('platform.batch-seed-allocations.edit')
        ->parameters([
            $batch->id,
            $batchSeedAllocation->id,
        ])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Batch seed allocation was removed successfully!');

    assertDatabaseMissing('batch_seed_allocations', $batchSeedAllocationData);
});
