<?php

namespace Database\Factories\Batch;

use App\Models\Batch\Batch;
use App\Models\Site\Municity;
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
        $municity = Municity::all()->random();
        $barangay = $this->faker->unique()->streetName;

        return [
            'farmschool_name' => $barangay.' School',
            'municity_id' => $municity->id,
            'province_id' => $municity->province->id,
            'region_id' => $municity->region->id,
            'barangay' => $barangay,
        ];
    }
}
