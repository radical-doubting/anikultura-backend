<?php

namespace Database\Factories\Farmer;

use App\Models\Farmer\FarmerProfile;
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
        $data = [
            'gender' => $this->faker->numberBetween(0, 2),
            'civil_status' => $this->faker->numberBetween(0, 4),
            'birthday' => $this->getRandomDate(),
            'age' => $this->faker->numberBetween(30, 70),
            'quantity_family_members' => $this->faker->numberBetween(1, 10),
            'quantity_dependents' => $this->faker->numberBetween(1, 10),
            'quantity_working_dependents' => $this->faker->numberBetween(1, 10),
            'highest_educational_status' => $this->faker->numberBetween(0, 2),
            'current_job' => $this->faker->jobTitle(),
            'farming_years' => $this->faker->numberBetween(1, 20),
            'usual_crops_planted' => $this->faker->numberBetween(10, 20),
            'affiliated_organization' => $this->faker->company(),
            'tesda_training_joined' => $this->faker->company(),
            'nc_passer_status' => $this->faker->numberBetween(0, 1),
            'salary_periodicity' => $this->faker->numberBetween(0, 5),
            'estimated_salary' => $this->faker->numberBetween(2000, 7000),
            'social_status' => $this->faker->numberBetween(0, 1),
            'social_status_reason' => $this->faker->realText(50, 1),
        ];

        if ($data['highest_educational_status'] == 2) {
            $data['college_course'] = $this->faker->stateAbbr().' '.$this->faker->jobTitle();
        } else {
            $data['college_course'] = 'N/A';
        }

        return $data;
    }

    private function getRandomDate()
    {
        $timestamp = mt_rand(1, time());

        return date('Y-M-d', $timestamp);
    }
}
