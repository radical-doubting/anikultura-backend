<?php

use App\Models\Farmland\Farmland;
use App\Models\User\Admin\Admin;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Farmland\FarmlandStatusSeeder;
use Database\Seeders\Farmland\FarmlandTypeSeeder;
use Database\Seeders\Farmland\WateringSystemSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Admin\AdminProfileSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
        SiteSeeder::class,
        FarmerSeeder::class,
        BatchSeeder::class,
        FarmlandTypeSeeder::class,
        FarmlandStatusSeeder::class,
        WateringSystemSeeder::class,
    ]);
});

it('shows list screen', function () {
    $screen = screen('platform.farmlands')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Farmland');
});

it('shows farmland in list screen', function () {
    $farmland = Farmland::factory()->createOne();

    $screen = screen('platform.farmlands')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($farmland->name);
});
