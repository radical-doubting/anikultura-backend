<?php

use App\Actions\User\Admin\CreateAdmin;
use App\Models\User\Admin\Admin;
use Database\Seeders\User\RoleSeeder;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
    ]);
});

it('adds an admin', function () {
    $admin = new Admin();

    $permissions = $admin->getStatusPermission()
        ->flatten()
        ->filter(fn ($value) => str_starts_with($value, 'platform'))
        ->map(fn ($value) => [base64_encode($value) => '0'])
        ->collapse()
        ->toArray();

    $adminData = [
        'account' => [
            'name' => 'admin',
            'first_name' => 'Juan',
            'middle_name' => 'Pedro',
            'last_name' => 'Dela Cruz',
            'email' => 'email@example.com',
            'contact_number' => '0917',
            'password' => 'password',
            'permissions' => $permissions,
        ],
        'profile' => [
            'age' => 31,
        ],
    ];

    /**
     * @var Admin
     */
    $createdAdmin = CreateAdmin::run($admin, $adminData);

    expect($createdAdmin->id)->toBeTruthy();
    expect($createdAdmin->name)->toBe('admin');

    $isValid = Hash::check('password', $createdAdmin->password);
    expect($isValid)->toBe(true);

    expect($createdAdmin->profile)->toBeTruthy();
    expect($createdAdmin->profile->age)->toBe(31);

    assertDatabaseCount('users', 1);
    assertDatabaseHas('users', [
        'name' => 'admin',
        'first_name' => 'Juan',
        'middle_name' => 'Pedro',
        'last_name' => 'Dela Cruz',
        'email' => 'email@example.com',
        'contact_number' => '0917',
    ]);

    assertDatabaseCount('admin_profiles', 1);
    assertDatabaseHas('admin_profiles', [
        'age' => 31,
    ]);
});
