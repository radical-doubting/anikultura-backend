<?php

namespace Database\Factories\Crop;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crop\Crop>
 */
class CropFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->firstName;

        return [
            'name' => $name,
            'group' => $name.' Group',
            'variety' => $name.' Variety',
            'gross_returns_per_ha' => $this->faker->numberBetween(100000, 150000),
            'total_costs_per_ha' => $this->faker->numberBetween(50000, 100000),
            'production_cost_per_kg' => $this->faker->randomFloat(2, 1, 15),
            'farmgate_price_per_kg' => $this->faker->randomFloat(2, 1, 30),
            'yield_per_ha' => $this->faker->numberBetween(2500, 6000),
            'maturity_lower_bound' => $this->faker->numberBetween(60, 100),
            'maturity_upper_bound' => $this->faker->numberBetween(120, 180),
        ];
    }
}
