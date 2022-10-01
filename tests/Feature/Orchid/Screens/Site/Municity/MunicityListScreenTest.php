<?php

namespace Tests\Feature\Orchid\Screens\Site\Municity;

use App\Models\User\Admin\Admin;
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

it('shows list screen', function () {
    $screen = screen('platform.sites.municities')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Municipalities and Cities'));
});
