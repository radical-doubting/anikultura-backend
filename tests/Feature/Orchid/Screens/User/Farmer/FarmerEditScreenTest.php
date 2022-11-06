<?php

use App\Models\Batch\Batch;
use App\Models\Farmland\Farmland;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Farmer\Farmer;
use App\Models\User\Farmer\FarmerAddress;
use App\Models\User\Farmer\FarmerProfile;
use Database\Seeders\Farmland\FarmlandStatusSeeder;
use Database\Seeders\Farmland\FarmlandTypeSeeder;
use Database\Seeders\Farmland\WateringSystemSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
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
        BigBrotherSeeder::class,
        SiteSeeder::class,
        GenderSeeder::class,
        CivilStatusSeeder::class,
        EducationalStatusSeeder::class,
        SalaryPeriodicitySeeder::class,
        SocialStatusSeeder::class,
        NCPasserStatusSeeder::class,
        FarmlandTypeSeeder::class,
        FarmlandStatusSeeder::class,
        WateringSystemSeeder::class,
    ]);
});

it('shows create screen as admin', function () {
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

it('shows create screen as big brother', function () {
    $screen = screen('platform.farmers.create')->actingAs(BigBrother::first());

    $screen->display()
        ->assertSee('Enroll farmer')
        ->assertSee('Account Information')
        ->assertSee('Personal Information')
        ->assertSee('Address Information')
        ->assertSee('Job and Education Information')
        ->assertSee('Salary Information')
        ->assertSee('Save');
});

it('shows any farmer from the edit screen as admin', function () {
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

it('does not show a non-belonging farmer from the edit screen as big brother', function () {
    $farmer = Farmer::factory()->createOne();

    $screen = screen('platform.farmers.edit')
        ->parameters([$farmer->id])
        ->actingAs(BigBrother::first());

    $screen->display()
        ->assertStatus(403);
});

it('shows a belonging farmer from the edit screen as big brother', function () {
    $bigBrother = BigBrother::first();

    /**
     * @var Farmer
     */
    $farmer = Farmer::factory()->createOne();

    /**
     * @var Batch
     */
    $batch = Batch::factory()->createOne();

    $batch->bigBrothers()->sync($bigBrother);
    $batch->farmers()->sync($farmer);

    $screen = screen('platform.farmers.edit')
        ->parameters([$farmer->id])
        ->actingAs($bigBrother);

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

it('creates a farmer from the create screen as admin', function () {
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

    /**
     * @var Batch
     */
    $batch = Batch::factory()->createOne();

    $farmland = Farmland::factory()->createOne([
        'batch_id' => $batch->id,
    ]);

    $farmerAssignmentData = [
        'batches' => [
            $batch->id,
        ],
        'farmlands' => [
            $farmland->id,
        ],
    ];

    $screen
        ->method('save', [
            'farmer' => [
                ...$farmerData,
                'password' => 'SuperSecurePassword1!',
            ],
            'farmerProfile' => $farmerProfileData,
            'farmerAddress' => $farmerAddressData,
            'farmerAssignment' => $farmerAssignmentData,
        ])
        ->assertSee('Farmer was saved successfully!');

    assertDatabaseCount('users', 12);
    assertDatabaseHas('users', $farmerData);
    assertDatabaseCount('farmer_profiles', 1);
    assertDatabaseCount('farmer_addresses', 1);
    assertDatabaseCount('batch_farmers', 1);
    assertDatabaseCount('farmland_farmers', 1);
});

it('creates a farmer from the create screen as big brother', function () {
    $bigBrother = BigBrother::first();

    $screen = screen('platform.farmers.create')
        ->actingAs($bigBrother);

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

    /**
     * @var Batch
     */
    $batch = Batch::factory()->createOne();
    $batch->bigBrothers()->sync($bigBrother);

    $farmland = Farmland::factory()->createOne([
        'batch_id' => $batch->id,
    ]);

    $farmerAssignmentData = [
        'batches' => [
            $batch->id,
        ],
        'farmlands' => [
            $farmland->id,
        ],
    ];

    $screen
        ->method('save', [
            'farmer' => [
                ...$farmerData,
                'password' => 'SuperSecurePassword1!',
            ],
            'farmerProfile' => $farmerProfileData,
            'farmerAddress' => $farmerAddressData,
            'farmerAssignment' => $farmerAssignmentData,
        ])
        ->assertSee('Farmer was saved successfully!');

    assertDatabaseCount('users', 12);
    assertDatabaseHas('users', $farmerData);
    assertDatabaseCount('farmer_profiles', 1);
    assertDatabaseCount('farmer_addresses', 1);
    assertDatabaseCount('batch_farmers', 1);
    assertDatabaseCount('farmland_farmers', 1);
});

it('deletes an existing farmer from the edit screen', function () {
    $farmerProfile = FarmerProfile::factory()->createOne();

    FarmerAddress::factory()->createOne([
        'farmer_profile_id' => $farmerProfile->id,
    ]);

    $farmer = Farmer::factory()->createOne([
        'profile_id' => $farmerProfile->id,
    ]);

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

    assertDatabaseCount('users', 11);
    assertDatabaseMissing('users', $farmerData);
    assertDatabaseCount('farmer_profiles', 0);
    assertDatabaseCount('farmer_addresses', 0);
});
