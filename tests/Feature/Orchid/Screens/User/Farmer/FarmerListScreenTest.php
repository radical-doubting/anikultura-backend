<?php

use App\Models\Batch\Batch;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Farmer\Farmer;
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
    $screen = screen('platform.farmers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Farmers');
});

it('shows list screen as big brother', function () {
    $screen = screen('platform.farmers')->actingAs(BigBrother::first());

    $screen->display()
        ->assertSee('Farmers');
});

it('shows any farmer in list screen as admin', function () {
    $farmer = Farmer::factory()->createOne();

    $screen = screen('platform.farmers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($farmer->first_name)
        ->assertSee($farmer->last_name);
});

it('does not show any farmer in list screen as big brother', function () {
    $farmer = Farmer::factory()->createOne();

    $screen = screen('platform.farmers')->actingAs(BigBrother::first());

    $screen->display()
        ->assertDontSee($farmer->first_name)
        ->assertDontSee($farmer->last_name);
});

it('shows belonging farmer in list screen as big brother', function () {
    $bigBrother = BigBrother::first();

    $farmer = Farmer::factory()->createOne();

    /**
     * @var Batch
     */
    $batch = Batch::factory()->createOne();

    $batch->bigBrothers()->sync($bigBrother);
    $batch->farmers()->sync($farmer);

    $screen = screen('platform.farmers')->actingAs($bigBrother);

    $screen->display()
        ->assertSee($farmer->first_name)
        ->assertSee($farmer->last_name);
});
