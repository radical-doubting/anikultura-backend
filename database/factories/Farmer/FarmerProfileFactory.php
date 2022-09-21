<?php

namespace Database\Factories\Farmer;

use App\Models\Farmer\CivilStatus;
use App\Models\Farmer\EducationalStatus;
use App\Models\Farmer\FarmerProfile;
use App\Models\Farmer\Gender;
use App\Models\Farmer\SalaryPeriodicity;
use App\Models\Farmer\SocialStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class FarmerProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FarmerProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $educationalStatus = EducationalStatus::all()->random();

        $data = [
            'gender_id' => Gender::all()->random()->id,
            'civil_status_id' => CivilStatus::all()->random()->id,
            'birthday' => $this->faker->date(),
            'quantity_family_members' => $this->faker->numberBetween(1, 10),
            'quantity_dependents' => $this->faker->numberBetween(1, 10),
            'quantity_working_dependents' => $this->faker->numberBetween(1, 10),
            'educational_status_id' => $educationalStatus->id,
            'current_job' => $this->faker->jobTitle(),
            'farming_years' => $this->faker->numberBetween(1, 20),
            'usual_crops_planted' => $this->faker->numberBetween(10, 20),
            'affiliated_organization' => $this->faker->company(),
            'tesda_training_joined' => $this->faker->company(),
            'nc_passer_status' => $this->faker->numberBetween(0, 1),
            'salary_periodicity_id' => SalaryPeriodicity::all()->random()->id,
            'estimated_salary' => $this->faker->numberBetween(2000, 7000),
            'social_status_id' => SocialStatus::all()->random()->id,
            'social_status_reason' => $this->faker->realText(50, 1),
        ];

        if ($educationalStatus->id == 3) {
            $data['college_course'] = $this->faker->stateAbbr().' '.$this->faker->jobTitle();
        }

        return $data;
    }
}
