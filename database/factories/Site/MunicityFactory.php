<?php

namespace Database\Factories\Site;

use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class MunicityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Municity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->cityPrefix . ' ' . $this->faker->city() . ' ' . $this->faker->citySuffix,
            'province_id' => Province::all()->random()->id,
            'region_id' => Region::all()->random()->id,
        ];
    }
}
