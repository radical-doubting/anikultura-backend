<?php

use App\Models\Admin\Admin;
use App\Models\Site\Province;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
        RegionSeeder::class,
    ]);
});

it('should show create screen', function () {
    $screen = screen('platform.sites.provinces.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Create'))
        ->assertSee(__('Province Information'))
        ->assertSee(__('Save'));
});

it('should show edit screen', function () {
    $province = Province::factory()->count(1)->create()[0];

    $screen = screen('platform.sites.provinces.edit')
        ->parameters([$province->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Edit province'))
        ->assertSee(__('Remove'))
        ->assertSee(__('Save'));
});
