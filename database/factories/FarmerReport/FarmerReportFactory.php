<?php

namespace Database\Factories\FarmerReport;

use App\Models\Crop\Crop;
use App\Models\Crop\SeedStage;
use App\Models\Farmland\Farmland;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FarmerReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'seed_stage_id' => SeedStage::first()->id,
            'farmland_id' => Farmland::all()->random()->id,
            'crop_id' => Crop::all()->random()->id,
            'volume_kg' => $this->faker->numberBetween(30, 100),
        ];
    }
}
