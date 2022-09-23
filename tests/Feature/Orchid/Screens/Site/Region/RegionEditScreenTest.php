<?php

use App\Models\Admin\Admin;
use App\Models\Site\Region;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
    ]);
});

it('should show create screen', function () {
    $screen = screen('platform.sites.regions.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Create'))
        ->assertSee(__('Region Information'))
        ->assertSee(__('Save'));
});

it('should show edit screen', function () {
    $region = Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);

    $screen = screen('platform.sites.regions.edit')
        ->parameters([$region->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Edit region'))
        ->assertSee(__('Remove'))
        ->assertSee(__('Save'));
});
