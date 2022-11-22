<?php

use App\Models\Site\Region;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        BigBrotherSeeder::class,
    ]);
});

it('shows list screen as admin', function () {
    $screen = screen('platform.sites.regions')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Region');
});

it('does not show list screen as big brother', function () {
    $screen = screen('platform.sites.regions')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows region in list screen as admin', function () {
    $region = Region::factory()->createOne();

    $screen = screen('platform.sites.regions')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($region->name)
        ->assertSee($region->short_name);
});
