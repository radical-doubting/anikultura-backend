<?php

use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        BigBrotherSeeder::class,
    ]);
});

it('shows list screen as admin', function () {
    $screen = screen('platform.big-brothers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Big Brothers');
});

it('does not show list screen as big brother', function () {
    $screen = screen('platform.big-brothers')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows big brother in list screen as admin', function () {
    $bigBrother = BigBrother::factory()->createOne();

    $screen = screen('platform.big-brothers')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($bigBrother->first_name)
        ->assertSee($bigBrother->last_name);
});
