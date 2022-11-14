<?php

use App\Models\Site\Province;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        BigBrotherSeeder::class,
        RegionSeeder::class,
    ]);
});

it('shows list screen as admin', function () {
    $screen = screen('platform.sites.provinces')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Province');
});

it('does not show list screen as big brother', function () {
    $screen = screen('platform.sites.provinces')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows province in list screen as admin', function () {
    $province = Province::factory()->createOne();

    $screen = screen('platform.sites.provinces')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($province->name)
        ->assertSee($province->region->name);
});
