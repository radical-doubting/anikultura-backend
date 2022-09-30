<?php

use App\Models\Admin\Admin;
use App\Models\Site\Province;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
        RegionSeeder::class,
    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.sites.provinces.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create province')
        ->assertSee('Province Information')
        ->assertSee('Save');
});

it('shows an existing province from the edit screen', function () {
    $province = Province::factory()->createOne();

    $screen = screen('platform.sites.provinces.edit')
        ->parameters([$province->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit province')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($province->name)
        ->assertSee($province->region->name);
});

it('creates a province from the create screen', function () {
    $province = Province::factory()->makeOne();
    $provinceData = $province->only(
        'name',
        'region_id'
    );

    $screen = screen('platform.sites.provinces.create')
        ->actingAs(Admin::first());

    $screen
        ->method('save', [
            'province' => $provinceData,
        ])
        ->assertSee('Province was saved successfully!');

    assertDatabaseHas('provinces', $provinceData);
});

it('deletes an existing province from the edit screen', function () {
    $province = Province::factory()->createOne();
    $provinceData = $province->only(
        'name',
        'region_id'
    );

    $screen = screen('platform.sites.provinces.edit')
        ->parameters([$province->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Province was removed successfully!');

    assertDatabaseMissing('provinces', $provinceData);
});
