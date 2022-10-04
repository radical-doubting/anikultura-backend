<?php

use App\Models\Crop\Crop;
use App\Models\User\Admin\Admin;
use Database\Seeders\User\Admin\AdminProfileSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
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
    $screen = screen('platform.crops.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create crop')
        ->assertSee('Basic Information')
        ->assertSee('Price Information')
        ->assertSee('Growth Information')
        ->assertSee('Save');
});

it('shows an existing crop from the edit screen', function () {
    $crop = Crop::factory()->createOne();

    $screen = screen('platform.crops.edit')
        ->parameters([$crop->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit crop')
        ->assertSee('Basic Information')
        ->assertSee('Price Information')
        ->assertSee('Growth Information')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($crop->name);
});

it('creates a crop from the create screen', function () {
    $screen = screen('platform.crops.create')
        ->actingAs(Admin::first());

    $crop = Crop::factory()->makeOne();

    $cropData = $crop->only(
        'group',
        'name',
        'variety',
        'gross_returns_per_ha',
        'total_costs_per_ha',
        'production_cost_per_kg',
        'farmgate_price_per_kg',
        'yield_per_ha',
        'maturity_lower_bound',
        'maturity_upper_bound',
    );

    $screen
        ->method('save', [
            'crop' => $cropData,
        ])
        ->assertSee('Crop was saved successfully!');

    assertDatabaseHas('crops', $cropData);
});

it('deletes an existing crop from the edit screen', function () {
    $crop = Crop::factory()->createOne();

    $cropData = $crop->only(
        'group',
        'name',
        'variety',
        'gross_returns_per_ha',
        'total_costs_per_ha',
        'production_cost_per_kg',
        'farmgate_price_per_kg',
        'yield_per_ha',
        'maturity_lower_bound',
        'maturity_upper_bound',
    );

    $screen = screen('platform.crops.edit')
        ->parameters([$crop->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Crop was removed successfully!');

    assertDatabaseMissing('crops', $cropData);
});
