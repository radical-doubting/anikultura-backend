<?php

use App\Models\Admin\Admin;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
    ]);
});

it('should show platform screen', function () {
    $screen = screen('platform.main')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Empowering')
        ->assertSee('Analytics Dashboard');
});
