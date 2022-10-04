<?php

namespace Database\Factories\Batch;

use App\Models\Batch\Batch;
use App\Models\Crop\Crop;
use App\Models\User\Farmer\Farmer;
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
            'batch_id' => Batch::all()->random()->id,
            'farmer_id' => Farmer::all()->random()->id,
            'crop_id' => Crop::all()->random()->id,
            'seed_amount' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
