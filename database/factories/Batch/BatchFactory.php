<?php

namespace Database\Factories\Batch;

use App\Models\Batch\Batch;
use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Batch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'farmschool_name' => $this->faker->unique()->state.' School',
            'municity_id' => Municity::all()->random()->id,
            'province_id' => Province::all()->random()->id,
            'region_id' => Region::all()->random()->id,
            'barangay' => $this->faker->streetName,
        ];
    }
}
