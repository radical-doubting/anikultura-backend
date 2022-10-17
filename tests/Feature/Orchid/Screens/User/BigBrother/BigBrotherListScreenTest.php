<?php

use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
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
    $screen = screen('platform.big-brothers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Big Brothers');
});

it('shows big brother in list screen', function () {
    $bigBrother = BigBrother::factory()->createOne();

    $screen = screen('platform.big-brothers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($bigBrother->first_name)
        ->assertSee($bigBrother->last_name);
});
