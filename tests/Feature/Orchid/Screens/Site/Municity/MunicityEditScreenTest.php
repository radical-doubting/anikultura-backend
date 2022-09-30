<?php

namespace Tests\Feature\Orchid\Screens\Site\Municity;

use App\Models\Admin\Admin;
use App\Models\Site\Municity;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Site\ProvinceSeeder;
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
        ProvinceSeeder::class,
    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.sites.municities.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create municipality or city')
        ->assertSee('Municipality or City Information')
        ->assertSee('Save');
});

it('shows an existing municipality or city from the edit screen', function () {
    $municity = Municity::factory()->createOne();

    $screen = screen('platform.sites.municities.edit')
        ->parameters([$municity->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit Municipality or City')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($municity->name)
        ->assertSee($municity->province->name)
        ->assertSee($municity->region->name);
});

it('creates a municipality or city from the create screen', function () {
    $municity = Municity::factory()->makeOne();
    $municityData = $municity->only(
        'name',
        'province_id',
        'region_id'
    );

    $screen = screen('platform.sites.municities.create')
        ->actingAs(Admin::first());

    $screen
        ->method('save', [
            'municity' => $municityData,
        ])
        ->assertSee('Municipality or city was saved successfully!');

    assertDatabaseHas('municities', $municityData);
});

it('deletes an existing municipality or city from the edit screen', function () {
    $municity = Municity::factory()->createOne();
    $municityData = $municity->only(
        'name',
        'province_id',
        'region_id'
    );

    $screen = screen('platform.sites.municities.edit')
        ->parameters([$municity->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Municipality or city was removed successfully!');

    assertDatabaseMissing('municities', $municityData);
});
