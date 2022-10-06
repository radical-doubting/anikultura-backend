<?php

use App\Actions\User\BigBrother\CreateBigBrother;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Role;
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

it('adds a big brother', function () {
    $bigBrother = new BigBrother();

    $bigBrotherData = [
        'account' => [
            'name' => 'bigBrother',
            'first_name' => 'Juan',
            'middle_name' => 'Pedro',
            'last_name' => 'Dela Cruz',
            'email' => 'email@example.com',
            'contact_number' => '0917',
            'password' => 'password',
        ],
        'profile' => [
            'age' => 27,
            'organization_name' => 'Acme Org',
        ],
    ];

    /**
     * @var BigBrother
     */
    $createdBigBrother = CreateBigBrother::run($bigBrother, $bigBrotherData);

    expect($createdBigBrother->id)->toBeTruthy();
    expect($createdBigBrother->name)->toBe('bigBrother');

    $isValid = Hash::check('password', $createdBigBrother->password);
    expect($isValid)->toBe(true);

    expect($createdBigBrother->profile)->toBeTruthy();
    expect($createdBigBrother->profile->age)->toBe(27);
    expect($createdBigBrother->profile->organization_name)->toBe('Acme Org');

    assertDatabaseCount('users', 1);
    assertDatabaseHas('users', [
        'name' => 'bigBrother',
        'first_name' => 'Juan',
        'middle_name' => 'Pedro',
        'last_name' => 'Dela Cruz',
        'email' => 'email@example.com',
        'contact_number' => '0917',
    ]);

    assertDatabaseCount('big_brother_profiles', 1);
    assertDatabaseHas('big_brother_profiles', [
        'age' => 27,
        'organization_name' => 'Acme Org',
    ]);

    assertDatabaseHas('role_users', [
        'user_id' => $createdBigBrother->id,
        'role_id' => Role::bigBrother()->id,
    ]);
});
