<?php

use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Role;
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
    $screen = screen('platform.roles')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Roles');
});

it('does not show list screen as big brother', function () {
    $screen = screen('platform.roles')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows role in list screen as admin', function () {
    $role = Role::first();

    $screen = screen('platform.roles')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($role->name);
});
