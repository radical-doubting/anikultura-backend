<?php

namespace Database\Factories\Batch;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Batch\BatchSeedAllocation>
 */
class BatchSeedAllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'seed_amount' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
