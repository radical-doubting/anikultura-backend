<?php

use App\Models\User\Admin\Admin;
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
    $screen = screen('platform.admins')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Admin');
});

it('shows admin in list screen', function () {
    $admin = Admin::first();
    $screen = screen('platform.admins')->actingAs($admin);

    $screen->display()
        ->assertSee($admin->first_name)
        ->assertSee($admin->last_name);
});
