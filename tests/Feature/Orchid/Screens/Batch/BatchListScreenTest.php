<?php

use App\Models\Batch\Batch;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        BigBrotherSeeder::class,
        SiteSeeder::class,
    ]);
});

it('shows list screen as admin', function () {
    $screen = screen('platform.batches')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Batch');
});

it('shows list screen as big brother', function () {
    $screen = screen('platform.batches')->actingAs(BigBrother::first());

    $screen->display()
        ->assertSee('Batch');
});

it('shows any batch in list screen as admin', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batches')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($batch->farmschool_name);
});

it('does not show any batch in list screen as big brother', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batches')->actingAs(BigBrother::first());

    $screen->display()
        ->assertDontSee($batch->farmschool_name);
});

it('shows belonging batch in list screen as big brother', function () {
    $bigBrother = BigBrother::first();

    /**
     * @var Batch
     */
    $batch = Batch::factory()->createOne();
    $batch->bigBrothers()->sync($bigBrother);

    $screen = screen('platform.batches')->actingAs($bigBrother);

    $screen->display()
        ->assertSee($batch->farmschool_name);
});
