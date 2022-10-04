<?php

use App\Models\Batch\Batch;
use App\Models\User\Admin\Admin;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Admin\AdminProfileSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        AdminProfileSeeder::class,
        SiteSeeder::class,
    ]);
});

it('shows list screen', function () {
    $screen = screen('platform.batches')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Batch');
});

it('shows batch in list screen', function () {
    $batch = Batch::factory()->createOne();

    $screen = screen('platform.batches')->actingAs(Admin::first());

    $screen->display()
        ->assertSee($batch->farmschool_name);
});
