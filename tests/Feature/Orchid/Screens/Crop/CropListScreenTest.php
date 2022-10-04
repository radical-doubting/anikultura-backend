<?php

use App\Models\Crop\Crop;
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
    $screen = screen('platform.crops')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Crop');
});

it('shows crop in list screen', function () {
    $crop = Crop::factory()->createOne();

    $screen = screen('platform.crops')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($crop->name);
});
