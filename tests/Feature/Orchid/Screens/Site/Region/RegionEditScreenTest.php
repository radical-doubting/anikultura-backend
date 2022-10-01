<?php

use App\Models\User\Admin\Admin;
use App\Models\Site\Region;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.sites.regions.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create region')
        ->assertSee('Region Information')
        ->assertSee('Save');
});

it('shows an existing region from the edit screen', function () {
    $region = Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);

    $screen = screen('platform.sites.regions.edit')
        ->parameters([$region->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit region')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($region->name)
        ->assertSee($region->short_name);
});

it('creates a region from the create screen', function () {
    $screen = screen('platform.sites.regions.create')
        ->actingAs(Admin::first());

    $regionData = [
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ];

    $screen
        ->method('save', [
            'region' => $regionData,
        ])
        ->assertSee('Region was saved successfully!');

    assertDatabaseHas('regions', $regionData);
});

it('deletes an existing region from the edit screen', function () {
    $regionData = [
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ];

    $region = Region::create($regionData);

    $screen = screen('platform.sites.regions.edit')
        ->parameters([$region->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Region was removed successfully!');

    assertDatabaseMissing('regions', $regionData);
});
