<?php

use App\Models\User\Admin\Admin;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
    ]);
});

it('shows list screen', function () {
    $screen = screen('platform.farmers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Farmers');
});

it('shows farmer in list screen', function () {
    $farmer = Farmer::factory()->createOne();

    $screen = screen('platform.farmers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($farmer->first_name)
        ->assertSee($farmer->last_name);
});
