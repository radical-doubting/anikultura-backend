<?php

use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\BigBrother\BigBrotherProfile;
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
    $screen = screen('platform.big-brothers.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create big brother')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Save');
});

it('shows an existing big brother from the edit screen', function () {
    $bigBrother = BigBrother::factory()->createOne();

    $screen = screen('platform.big-brothers.edit')
        ->parameters([$bigBrother->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit big brother')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($bigBrother->first_name)
        ->assertSee($bigBrother->last_name);
});

it('creates a big brother from the create screen', function () {
    $screen = screen('platform.big-brothers.create')
        ->actingAs(Admin::first());

    /**
     * @var BigBrother
     */
    $bigBrother = BigBrother::factory()->makeOne();

    $bigBrotherData = $bigBrother->only(
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number'
    );

    $bigBrotherProfile = BigBrotherProfile::factory()->makeOne();
    $bigBrotherProfileData = $bigBrotherProfile->only(
        'age',
        'organization_name',
    );

    $screen
        ->method('save', [
            'bigBrother' => [
                ...$bigBrotherData,
                'password' => 'SuperSecurePassword1!',
            ],
            'bigBrotherProfile' => $bigBrotherProfileData,
        ])
        ->assertSee('Big brother was saved successfully!');

    assertDatabaseCount('users', 2);
    assertDatabaseHas('users', $bigBrotherData);
    assertDatabaseCount('big_brother_profiles', 1);
    assertDatabaseHas('big_brother_profiles', $bigBrotherProfileData);
});

it('deletes an existing big brother from the edit screen', function () {
    $bigBrotherProfile = BigBrotherProfile::factory()->createOne();
    $bigBrother = BigBrother::factory()->createOne([
        'profile_id' => $bigBrotherProfile->id,
    ]);

    $bigBrotherProfileData = $bigBrotherProfile->only(
        'age',
        'organization_name',
    );

    $bigBrotherData = $bigBrother->only(
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number'
    );

    $screen = screen('platform.big-brothers.edit')
        ->parameters([$bigBrother->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Big brother was removed successfully!');

    assertDatabaseMissing('users', $bigBrotherData);
    assertDatabaseMissing('big_brother_profiles', $bigBrotherProfileData);
});
