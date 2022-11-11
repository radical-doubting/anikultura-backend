<?php

use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\BigBrother\BigBrotherProfile;
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
    $screen = screen('platform.big-brothers.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Create big brother')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Save');
});

it('does not show create screen as big brother', function () {
    $screen = screen('platform.big-brothers.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows an existing big brother from the edit screen as admin', function () {
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

it('does now show an existing big brother from the edit screen as admin', function () {
    $bigBrother = BigBrother::factory()->createOne();

    $screen = screen('platform.big-brothers.edit')
        ->parameters([$bigBrother->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('creates a big brother from the create screen as admin', function () {
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

    assertDatabaseCount('users', 12);
    assertDatabaseHas('users', $bigBrotherData);
    assertDatabaseCount('big_brother_profiles', 11);
});

it('deletes an existing big brother from the edit screen as admin', function () {
    $bigBrotherProfile = BigBrotherProfile::factory()->createOne();
    $bigBrother = BigBrother::factory()->createOne([
        'profile_id' => $bigBrotherProfile->id,
    ]);

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

    assertDatabaseCount('users', 11);
    assertDatabaseMissing('users', $bigBrotherData);
    assertDatabaseCount('big_brother_profiles', 10);
});
