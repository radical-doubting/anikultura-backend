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
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
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

it('shows create screen as admin', function () {
    $screen = screen('platform.sites.municities.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create municipality or city')
        ->assertSee('Municipality or City Information')
        ->assertSee('Save');
});

it('does not show create screen as big brother', function () {
    $screen = screen('platform.sites.municities.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing municipality or city from the edit screen as admin', function () {
    $municity = Municity::factory()->createOne();

    $screen = screen('platform.sites.municities.edit')
        ->parameters([$municity->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit Municipality or City')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($municity->name)
        ->assertSee($municity->province->name);
});

it('does not show an existing region from the edit screen as big brother', function () {
    $municity = Municity::factory()->createOne();

    $screen = screen('platform.sites.municities.edit')
        ->parameters([$municity->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('creates a municipality or city from the create screen as admin', function () {
    $municity = Municity::factory()->makeOne();
    $municityData = $municity->only(
        'name',
        'province_id'
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

it('deletes an existing municipality or city from the edit screen as admin', function () {
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
