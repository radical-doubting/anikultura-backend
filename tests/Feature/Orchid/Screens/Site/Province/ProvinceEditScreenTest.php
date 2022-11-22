<?php

use App\Models\Site\Province;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        BigBrotherSeeder::class,
        RegionSeeder::class,
    ]);
});

it('shows create screen as admin', function () {
    $screen = screen('platform.sites.provinces.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create province')
        ->assertSee('Province Information')
        ->assertSee('Save');
});

it('does not show create screen as big brother', function () {
    $screen = screen('platform.sites.provinces.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing province from the edit screen as admin', function () {
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

it('does not show an existing region from the edit screen as big brother', function () {
    $province = Province::factory()->createOne();

    $screen = screen('platform.sites.provinces.edit')
        ->parameters([$province->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('creates a province from the create screen as admin', function () {
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

it('deletes an existing province from the edit screen as admin', function () {
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
