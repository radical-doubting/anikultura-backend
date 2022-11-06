<?php

use App\Models\Batch\Batch;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Farmer\Farmer;
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
    ]);
});

it('shows create screen as admin', function () {
    $screen = screen('platform.batches.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create batch')
        ->assertSee('Batch Information')
        ->assertSee('Batch Site')
        ->assertSee('Batch Members')
        ->assertSee('Farmers')
        ->assertSee('Big Brothers')
        ->assertSee('Save');
});

it('does not show create screen as big brother', function () {
    $screen = screen('platform.batches.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing batch from the edit screen as admin', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batches.edit')
        ->parameters([$batch->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit batch')
        ->assertSee('Batch Information')
        ->assertSee('Seeds Allocation')
        ->assertSee('Batch Site')
        ->assertSee('Batch Members')
        ->assertSee('Farmers')
        ->assertSee('Big Brothers')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($batch->farmschool_name);
});

it('does not show non-belonging batch from the edit screen as big brother', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batches.edit')
        ->parameters([$batch->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing batch from the edit screen as big brother', function () {
    $bigBrother = BigBrother::first();

    /**
     * @var Batch
     */
    $batch = Batch::factory()->createOne();
    $batch->bigBrothers()->sync($bigBrother);

    $screen = screen('platform.batches.edit')
        ->parameters([$batch->id])
        ->actingAs($bigBrother);

    $screen->display()
        ->assertSee('Edit batch')
        ->assertSee('Batch Information')
        ->assertSee('Seeds Allocation')
        ->assertSee('Batch Site')
        ->assertSee('Batch Members')
        ->assertSee('Farmers')
        ->assertDontSee('Big Brothers')
        ->assertDontSee('Remove')
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
    $randomBigBrotherId = BigBrother::all()->random()->id;

    $screen
        ->method('save', [
            'batch' => [
                ...$batchData,
                'farmers' => [
                    $randomFarmerId,
                ],
                'bigBrothers' => [
                    $randomBigBrotherId,
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
