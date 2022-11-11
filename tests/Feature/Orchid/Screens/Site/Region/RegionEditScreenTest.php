<?php

use App\Models\Site\Region;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
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
    ]);
});

it('shows create screen as admin', function () {
    $screen = screen('platform.sites.regions.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create region')
        ->assertSee('Region Information')
        ->assertSee('Save');
});

it('does not show create screen as big brother', function () {
    $screen = screen('platform.sites.regions.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing region from the edit screen as admin', function () {
    $region = Region::factory()->createOne();

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

it('does not show an existing region from the edit screen as big brother', function () {
    $region = Region::factory()->createOne();

    $screen = screen('platform.sites.regions.edit')
        ->parameters([$region->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('creates a region from the create screen as admin', function () {
    $region = Region::factory()->makeOne();
    $regionData = $region->only(
        'name',
        'short_name'
    );

    $screen = screen('platform.sites.regions.create')
        ->actingAs(Admin::first());

    $screen
        ->method('save', [
            'region' => $regionData,
        ])
        ->assertSee('Region was saved successfully!');

    assertDatabaseHas('regions', $regionData);
});

it('deletes an existing region from the edit screen as admin', function () {
    $region = Region::factory()->createOne();
    $regionData = $region->only(
        'name',
        'short_name'
    );

    $screen = screen('platform.sites.regions.edit')
        ->parameters([$region->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Region was removed successfully!');

    assertDatabaseMissing('regions', $regionData);
});
