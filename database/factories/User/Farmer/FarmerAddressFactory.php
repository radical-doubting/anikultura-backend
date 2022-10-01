<?php

namespace Database\Factories\User\Farmer;

use App\Models\Site\Region;
use App\Models\User\Farmer\FarmerAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class FarmerAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FarmerAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'house_number' => $this->faker->buildingNumber,
            'street' => $this->faker->streetAddress,
            'barangay' => $this->faker->streetName,
            'municity' => $this->faker->city,
            'province' => $this->faker->state,
            'region_id' => Region::all()->random()->id,
        ];
    }
}
