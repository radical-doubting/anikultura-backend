<?php

use App\Models\User\Admin\Admin;
use App\Models\User\Role;
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
    $screen = screen('platform.roles')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Roles');
});

it('shows role in list screen', function () {
    $role = Role::first();

    $screen = screen('platform.roles')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($role->name);
});
