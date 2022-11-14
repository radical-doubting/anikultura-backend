<?php

use App\Models\User\Admin\Admin;
use App\Models\User\Admin\AdminProfile;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        BigBrotherSeeder::class,
    ]);
});

it('shows create screen as admin', function () {
    $screen = screen('platform.admins.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create administrator')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Permissions')
        ->assertSee('Save');
});

it('does not show create screen as big brother', function () {
    $screen = screen('platform.admins.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing admin from the edit screen as admin', function () {
    $loggedInAdmin = Admin::first();
    $admin = Admin::factory()->createOne();

    $screen = screen('platform.admins.edit')
        ->parameters([$admin->id])
        ->actingAs($loggedInAdmin);

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

it('does not show an existing admin from the edit screen as big brother', function () {
    $admin = Admin::factory()->createOne();

    $screen = screen('platform.admins.edit')
        ->parameters([$admin->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('creates an admin from the create screen as admin', function () {
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
                'password' => 'SuperSecurePassword1!',
                'permissions' => $permissions,
            ],
            'adminProfile' => $adminProfileData,
        ])
        ->assertSee('Administrator was saved successfully!');

    assertDatabaseCount('users', 12);
    assertDatabaseHas('users', $adminData);
    assertDatabaseCount('admin_profiles', 2);
});

it('deletes an existing admin from the edit screen as admin', function () {
    $loggedInAdmin = Admin::first();
    $adminProfile = AdminProfile::factory()->createOne();
    $admin = Admin::factory()->createOne([
        'profile_id' => $adminProfile->id,
    ]);

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
        ->actingAs($loggedInAdmin);

    $screen
        ->method('remove')
        ->assertSee('Administrator was removed successfully!');

    assertDatabaseCount('users', 11);
    assertDatabaseMissing('users', $adminData);
    assertDatabaseCount('admin_profiles', 1);
});
