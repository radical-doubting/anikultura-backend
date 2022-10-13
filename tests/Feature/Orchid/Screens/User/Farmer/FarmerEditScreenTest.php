<?php

use App\Models\User\Admin\Admin;
use App\Models\User\Farmer\Farmer;
use App\Models\User\Farmer\FarmerAddress;
use App\Models\User\Farmer\FarmerProfile;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\Farmer\CivilStatusSeeder;
use Database\Seeders\User\Farmer\EducationalStatusSeeder;
use Database\Seeders\User\Farmer\GenderSeeder;
use Database\Seeders\User\Farmer\NCPasserStatusSeeder;
use Database\Seeders\User\Farmer\SalaryPeriodicitySeeder;
use Database\Seeders\User\Farmer\SocialStatusSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
        RegionSeeder::class,
        GenderSeeder::class,
        CivilStatusSeeder::class,
        EducationalStatusSeeder::class,
        SalaryPeriodicitySeeder::class,
        SocialStatusSeeder::class,
        NCPasserStatusSeeder::class,
    ]);
});

it('shows create screen', function () {
    $screen = screen('platform.farmers.create')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Enroll farmer')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Address Information')
        ->assertSee('Job and Education Information')
        ->assertSee('Salary Information')
        ->assertSee('Save');
});

it('shows an existing farmer from the edit screen', function () {
    $farmer = Farmer::factory()->createOne();

    $screen = screen('platform.farmers.edit')
        ->parameters([$farmer->id])
        ->actingAs(Admin::first());

    $screen->display()
        ->assertSee('Edit farmer')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Address Information')
        ->assertSee('Job and Education Information')
        ->assertSee('Salary Information')
        ->assertSee('Remove')
        ->assertSee('Save')
        ->assertSee($farmer->first_name)
        ->assertSee($farmer->last_name);
});

it('creates a farmer from the create screen', function () {
    $screen = screen('platform.farmers.create')
        ->actingAs(Admin::first());

    /**
     * @var Farmer
     */
    $farmer = Farmer::factory()->makeOne();

    $farmerData = $farmer->only(
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number'
    );

    $farmerProfile = FarmerProfile::factory()->makeOne();
    $farmerProfileData = $farmerProfile->only(
        'gender_id',
        'civil_status_id',
        'birthday',
        'quantity_family_members',
        'quantity_dependents',
        'quantity_working_dependents',
        'educational_status_id',
        'college_course',
        'current_job',
        'farming_years',
        'usual_crops_planted',
        'affiliated_organization',
        'tesda_training_joined',
        'nc_passer_status_id',
        'salary_periodicity_id',
        'estimated_salary',
        'social_status_id',
        'social_status_reason',
    );

    $farmerAddress = FarmerAddress::factory()->makeOne();
    $farmerAddressData = $farmerAddress->only(
        'house_number',
        'street',
        'barangay',
        'municity',
        'province',
        'region_id',
    );

    $screen
        ->method('save', [
            'farmer' => [
                ...$farmerData,
                'password' => 'SuperSecurePassword1!',
            ],
            'farmerProfile' => $farmerProfileData,
            'farmerAddress' => $farmerAddressData,
        ])
        ->assertSee('Farmer was saved successfully!');

    assertDatabaseCount('users', 2);
    assertDatabaseHas('users', $farmerData);
    assertDatabaseCount('farmer_profiles', 1);
    assertDatabaseHas('farmer_profiles', $farmerProfileData);
});

it('deletes an existing farmer from the edit screen', function () {
    $farmerProfile = FarmerProfile::factory()->createOne();

    $farmerAddress = FarmerAddress::factory()->createOne([
        'farmer_profile_id' => $farmerProfile->id,
    ]);

    $farmer = Farmer::factory()->createOne([
        'profile_id' => $farmerProfile->id,
    ]);

    $farmerProfileData = $farmerProfile->only(
        'gender_id',
        'civil_status_id',
        'birthday',
        'quantity_family_members',
        'quantity_dependents',
        'quantity_working_dependents',
        'educational_status_id',
        'college_course',
        'current_job',
        'farming_years',
        'usual_crops_planted',
        'affiliated_organization',
        'tesda_training_joined',
        'nc_passer_status_id',
        'salary_periodicity_id',
        'estimated_salary',
        'social_status_id',
        'social_status_reason',
    );

    $farmerAddressData = $farmerAddress->only(
        'house_number',
        'street',
        'barangay',
        'municity',
        'province',
        'region_id',
    );

    $farmerData = $farmer->only(
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number'
    );

    $screen = screen('platform.farmers.edit')
        ->parameters([$farmer->id])
        ->actingAs(Admin::first());

    $screen
        ->method('remove')
        ->assertSee('Farmer was removed successfully!');

    assertDatabaseMissing('users', $farmerData);
    assertDatabaseMissing('farmer_profiles', $farmerProfileData);
    assertDatabaseMissing('farmer_addresses', $farmerAddressData);
});
