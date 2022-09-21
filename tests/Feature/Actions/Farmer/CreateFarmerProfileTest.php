<?php

use App\Actions\Farmer\CreateFarmerProfile;
use App\Models\Farmer\CivilStatus;
use App\Models\Farmer\EducationalStatus;
use App\Models\Farmer\FarmerProfile;
use App\Models\Farmer\Gender;
use App\Models\Farmer\NCPasserStatus;
use App\Models\Farmer\SalaryPeriodicity;
use App\Models\Farmer\SocialStatus;
use Database\Seeders\Farmer\CivilStatusSeeder;
use Database\Seeders\Farmer\EducationalStatusSeeder;
use Database\Seeders\Farmer\GenderSeeder;
use Database\Seeders\Farmer\NCPasserStatusSeeder;
use Database\Seeders\Farmer\SalaryPeriodicitySeeder;
use Database\Seeders\Farmer\SocialStatusSeeder;

beforeEach(function () {
    $this->seed(GenderSeeder::class);
    $this->seed(CivilStatusSeeder::class);
    $this->seed(EducationalStatusSeeder::class);
    $this->seed(SalaryPeriodicitySeeder::class);
    $this->seed(SocialStatusSeeder::class);
    $this->seed(NCPasserStatusSeeder::class);
});

it('should add a farmer profile', function () {
    $gender = Gender::all()->random();
    $civilStatus = CivilStatus::all()->random();
    $educationalStatus = EducationalStatus::all()->random();
    $ncPasserStatus = NCPasserStatus::all()->random();
    $salaryPeriodicity = SalaryPeriodicity::all()->random();
    $socialStatus = SocialStatus::all()->random();

    $farmerProfileData = [
        'gender_id' => $gender->id,
        'civil_status_id' => $civilStatus->id,
        'birthday' => '1990-11-12',
        'quantity_family_members' => 3,
        'quantity_dependents' => 3,
        'quantity_working_dependents' => 2,
        'educational_status_id' => $educationalStatus->id,
        'current_job' => 'Acme Job',
        'farming_years' => 5,
        'usual_crops_planted' => 10,
        'affiliated_organization' => 'Acme Company',
        'tesda_training_joined' => 'Acme Training',
        'nc_passer_status_id' => $ncPasserStatus->id,
        'salary_periodicity_id' => $salaryPeriodicity->id,
        'estimated_salary' => 12000,
        'social_status_id' => $socialStatus->id,
        'social_status_reason' => 'An example reason',
    ];

    /**
     * @var FarmerProfile
     */
    $createdFarmerProfile = CreateFarmerProfile::run(
        new FarmerProfile(),
        $farmerProfileData
    );

    expect($createdFarmerProfile->id)->toBeTruthy();
    expect($createdFarmerProfile->gender->name)->toBe($gender->name);
    expect($createdFarmerProfile->civilStatus->name)->toBe($civilStatus->name);
    expect($createdFarmerProfile->educationalStatus->name)->toBe($educationalStatus->name);
    expect($createdFarmerProfile->ncPasserStatus->name)->toBe($ncPasserStatus->name);
    expect($createdFarmerProfile->salaryPeriodicity->name)->toBe($salaryPeriodicity->name);
    expect($createdFarmerProfile->socialStatus->name)->toBe($socialStatus->name);
    expect($createdFarmerProfile->created_at)->toBeTruthy();
    expect($createdFarmerProfile->updated_at)->toBeTruthy();

    $this->assertDatabaseCount('farmer_profiles', 1);
    $this->assertDatabaseHas('farmer_profiles', $farmerProfileData);
});
