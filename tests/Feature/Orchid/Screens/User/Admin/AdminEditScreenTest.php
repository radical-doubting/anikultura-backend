<?php

use App\Models\User\Admin\Admin;
use App\Models\User\Admin\AdminProfile;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.admins.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create administrator')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Permissions')
        ->assertSee('Save');
});

it('shows an existing admin from the edit screen', function () {
    $admin = Admin::factory()->createOne();

    $screen = screen('platform.admins.edit')
        ->parameters([$admin->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit administrator')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Permissions')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($admin->first_name)
        ->assertSee($admin->last_name);
});

it('creates an admin from the create screen', function () {
    $screen = screen('platform.admins.create')
        ->actingAs(Admin::first());

    /**
     * @var Admin
     */
    $admin = Admin::factory()->makeOne();

    $adminData = $admin->only(
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number'
    );

    $adminProfile = AdminProfile::factory()->makeOne();
    $adminProfileData = $adminProfile->only(
        'age'
    );

    $permissions = $admin->getStatusPermission()
        ->flatten()
        ->filter(fn ($value) => str_starts_with($value, 'platform'))
        ->map(fn ($value) => [base64_encode($value) => '0'])
        ->collapse()
        ->toArray();

    $screen
        ->method('save', [
            'admin' => [
                ...$adminData,
                'password' => 'password',
                'permissions' => $permissions,
            ],
            'adminProfile' => $adminProfileData,
        ])
        ->assertSee('Administrator was saved successfully!');

    assertDatabaseCount('users', 2);
    assertDatabaseHas('users', $adminData);
    assertDatabaseCount('admin_profiles', 2);
    assertDatabaseHas('admin_profiles', $adminProfileData);
});

it('deletes an existing admin from the edit screen', function () {
    $adminProfile = AdminProfile::factory()->createOne();
    $admin = Admin::factory()->createOne([
        'profile_id' => $adminProfile->id,
    ]);

    $adminProfileData = $adminProfile->only(
        'age',
    );

    $adminData = $admin->only(
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number'
    );

    $screen = screen('platform.admins.edit')
        ->parameters([$admin->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Administrator was removed successfully!');

    assertDatabaseMissing('users', $adminData);
    assertDatabaseMissing('admin_profiles', $adminProfileData);
});
