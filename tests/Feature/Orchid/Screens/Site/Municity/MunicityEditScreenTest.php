<?php

namespace Tests\Feature\Orchid\Screens\Site\Municity;

use App\Models\Admin\Admin;
use App\Models\Site\Municity;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Site\ProvinceSeeder;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
        RegionSeeder::class,
        ProvinceSeeder::class,

    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.sites.municities.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Create'))
        ->assertSee(__('Municipality or City Information'))
        ->assertSee(__('Save'));
});

it('shows edit screen', function () {
    $municity = Municity::factory()->count(1)->create()[0];

    $screen = screen('platform.sites.municities.edit')
        ->parameters([$municity->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Edit Municipality or City'))
        ->assertSee(__('Remove'))
        ->assertSee(__('Save'));
});
