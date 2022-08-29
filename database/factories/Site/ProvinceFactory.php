<?php

namespace Database\Factories\Site;

use App\Models\Site\Province;
use App\Models\Site\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Province::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->province,
            'region_id' => Region::all()->random()->id,
        ];
    }
}
