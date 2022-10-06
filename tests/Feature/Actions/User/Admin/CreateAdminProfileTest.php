<?php

use App\Actions\User\Admin\CreateAdminProfile;
use App\Models\User\Admin\AdminProfile;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
    ]);
});

it('adds an admin profile', function () {
    $adminProfileData = [
        'age' => 25,
    ];

    /**
     * @var AdminProfile
     */
    $createdAdminProfile = CreateAdminProfile::run(
        new AdminProfile(),
        $adminProfileData
    );

    expect($createdAdminProfile->id)->toBeTruthy();
    expect($createdAdminProfile->age)->toBe(25);

    assertDatabaseCount('admin_profiles', 1);
    assertDatabaseHas('admin_profiles', $adminProfileData);
});
