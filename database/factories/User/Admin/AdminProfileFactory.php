<?php

namespace Database\Factories\User\Admin;

use App\Models\User\Admin\AdminProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'age' => $this->faker->numberBetween(30, 70),
        ];
    }
}
