<?php

use App\Models\Site\Region;
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
    $screen = screen('platform.sites.regions')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Region'));
});

it('shows region in list screen', function () {
    Region::create([
        'name' => 'Some Example Region',
        'short_name' => 'SER',
    ]);

    $screen = screen('platform.sites.regions')->actingAs(Admin::first());

    $screen->display()
        ->assertSee(__('Some Example Region'))
        ->assertSee(__('SER'));
});
