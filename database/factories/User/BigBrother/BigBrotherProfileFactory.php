<?php

namespace Database\Factories\User\BigBrother;

use App\Models\User\BigBrother\BigBrotherProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class BigBrotherProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BigBrotherProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'age' => $this->faker->numberBetween(30, 70),
            'organization_name' => $this->faker->unique()->company(),
        ];
    }
}
