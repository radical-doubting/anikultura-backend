<?php

use App\Models\User\Admin\Admin;
use App\Models\User\Role;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.roles.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Manage roles')
        ->assertSee('Role')
        ->assertSee('Permission/Privilege');
});

it('shows an existing role from the edit screen', function () {
    $role = Role::first();

    $screen = screen('platform.roles.edit')
        ->parameters([$role->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Manage roles')
        ->assertSee('Role')
        ->assertSee('Permission/Privilege')
        ->assertSee($role->name)
        ->assertSee($role->slug);
});

it('creates a role from the create screen', function () {
    $screen = screen('platform.roles.create')
        ->actingAs(Admin::first());

    $roleData = [
        'name' => 'Moderator',
        'slug' => 'moderator',
    ];

    $screen
        ->method('save', [
            'role' => $roleData,
            'permissions' => [],
        ])
        ->assertSee('Role was saved successfully!');

    assertDatabaseHas('roles', $roleData);
});

it('deletes an existing role from the edit screen', function () {
    $roleData = [
        'name' => 'Moderator',
        'slug' => 'moderator',
    ];

    $role = Role::create($roleData);

    $screen = screen('platform.roles.edit')
        ->parameters([$role->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Role was removed successfully!');

    assertDatabaseMissing('roles', $roleData);
});
