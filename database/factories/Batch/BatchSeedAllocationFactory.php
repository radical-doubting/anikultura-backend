<?php

namespace Database\Factories\Batch;

use App\Models\Crop\Crop;
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
            'crop_id' => Crop::all()->random()->id,
            'seed_amount' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
