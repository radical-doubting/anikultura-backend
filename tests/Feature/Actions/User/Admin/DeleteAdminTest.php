<?php

use App\Actions\User\Admin\DeleteAdmin;
use App\Models\User\Admin\Admin;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RoleSeeder::class);
    seed(AdminSeeder::class);
});

it('deletes an admin', function () {
    /**
     * @var Admin
     */
    $admin = Admin::first();
    $adminProfileId = $admin->profile->id;

    /**
     * @var bool
     */
    $isDeleted = DeleteAdmin::run($admin);

    expect($isDeleted)->toBe(true);

    expect($admin->exists)->toBe(false);

    assertDatabaseMissing('users', [
        'name' => $admin->name,
    ]);

    assertDatabaseMissing('admin_profiles', [
        'id' => $adminProfileId,
    ]);
});
