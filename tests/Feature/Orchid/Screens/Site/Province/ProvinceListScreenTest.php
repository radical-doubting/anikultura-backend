<?php

use App\Models\User\Admin\Admin;
use Database\Seeders\User\Admin\AdminProfileSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
    ]);
});

it('shows list screen', function () {
    $screen = screen('platform.sites.provinces')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Province'));
});
