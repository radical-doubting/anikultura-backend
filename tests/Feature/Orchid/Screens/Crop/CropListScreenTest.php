<?php

use App\Models\Crop\Crop;
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
    $screen = screen('platform.crops')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Crop');
});

it('does not show list screen as big brother', function () {
    $screen = screen('platform.crops')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows crop in list screen as admin', function () {
    $crop = Crop::factory()->createOne();

    $screen = screen('platform.crops')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($crop->name);
});
