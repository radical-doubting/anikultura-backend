<?php

namespace Tests\Feature\Orchid\Screens\Site\Municity;

use App\Models\Site\Municity;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\Site\ProvinceSeeder;
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
        ProvinceSeeder::class,
    ]);
});

it('shows list screen as admin', function () {
    $screen = screen('platform.sites.municities')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Municipalities and Cities'));
});

it('does not show list screen as big brother', function () {
    $screen = screen('platform.sites.municities')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows municity in list screen as admin', function () {
    $municity = Municity::factory()->createOne();

    $screen = screen('platform.sites.municities')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($municity->name)
        ->assertSee($municity->region->name)
        ->assertSee($municity->province->name);
});
