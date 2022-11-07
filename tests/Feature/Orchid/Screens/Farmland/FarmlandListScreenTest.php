<?php

use App\Models\Batch\Batch;
use App\Models\Farmland\Farmland;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Farmland\FarmlandStatusSeeder;
use Database\Seeders\Farmland\FarmlandTypeSeeder;
use Database\Seeders\Farmland\WateringSystemSeeder;
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
        BatchSeeder::class,
        FarmlandTypeSeeder::class,
        FarmlandStatusSeeder::class,
        WateringSystemSeeder::class,
    ]);
});

it('shows list screen as admin', function () {
    $screen = screen('platform.farmlands')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Farmland');
});

it('shows list screen as big brother', function () {
    $screen = screen('platform.farmlands')->actingAs(BigBrother::first());

    $screen->display()
        ->assertSee('Farmland');
});

it('shows any farmland in list screen as admin', function () {
    $farmland = Farmland::factory()->createOne();

    $screen = screen('platform.farmlands')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($farmland->name);
});

it('does not show any farmland in list screen as big brother', function () {
    $farmland = Farmland::factory()->createOne();

    $screen = screen('platform.farmlands')->actingAs(BigBrother::first());

    $screen->display()
        ->assertDontSee($farmland->name);
});

it('shows belonging farmland in list screen as big brother', function () {
    $bigBrother = BigBrother::first();

    /**
     * @var Batch
     */
    $batch = Batch::first();
    $batch->bigBrothers()->sync($bigBrother);

    $farmland = Farmland::factory()->createOne([
        'batch_id' => $batch->id,
    ]);

    $screen = screen('platform.farmlands')->actingAs($bigBrother);

    $screen->display()
        ->assertSee($farmland->name);
});
