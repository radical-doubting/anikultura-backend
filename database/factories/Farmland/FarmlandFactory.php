<?php

namespace Database\Factories\Farmland;

use App\Models\Farmland\Farmland;
use Illuminate\Database\Eloquent\Factories\Factory;

class FarmlandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Farmland::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->state . ' Farmland',
            'hectares_size' => $this->faker->numberBetween(40, 1000),
            'type_id' => $this->faker->numberBetween(1, 2),
            'status_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
