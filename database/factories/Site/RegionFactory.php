<?php

namespace Database\Factories\Site;

use App\Models\Site\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Region::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->city();

        return [
            'name' => $name,
            'short_name' => strtoupper(substr($name, 0, 3)),
        ];
    }
}
