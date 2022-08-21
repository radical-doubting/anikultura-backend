<?php

namespace Database\Factories\Farmland;

use App\Models\Batch\Batch;
use App\Models\Farmland\Farmland;
use App\Models\Farmland\FarmlandStatus;
use App\Models\Farmland\FarmlandType;
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
            'name' => $this->faker->state.' Farmland',
            'batch_id' => Batch::all()->random()->id,
            'hectares_size' => $this->faker->randomFloat(2, 1, 10),
            'type_id' => FarmlandType::all()->random()->id,
            'status_id' => FarmlandStatus::all()->random()->id,
        ];
    }
}
