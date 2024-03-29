<?php

use App\Models\Crop\Crop;
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
    $screen = screen('platform.crops.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create crop')
        ->assertSee('Basic Information')
        ->assertSee('Price Information')
        ->assertSee('Growth Information')
        ->assertSee('Save');
});

it('does not show create screen as big brother', function () {
    $screen = screen('platform.crops.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing crop from the edit screen as admin', function () {
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

it('does not show an existing crop from the edit screen as big brother', function () {
    $crop = Crop::factory()->createOne();

    $screen = screen('platform.crops.edit')
        ->parameters([$crop->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('creates a crop from the create screen as admin', function () {
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

it('deletes an existing crop from the edit screen as admin', function () {
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
