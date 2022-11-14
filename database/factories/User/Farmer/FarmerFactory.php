<?php

namespace Database\Factories\User\Farmer;

use App\Models\User\Farmer\Farmer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class FarmerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Farmer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = $this->faker->unique()->firstName;
        $randomNumber = $this->faker->numberBetween(1, 99);
        $username = strtolower("$firstName$randomNumber");

        return [
            'name' => $username,
            'email' => "$username@gmail.com",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'first_name' => $firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'profile_type' => Farmer::PROFILE_PATH,
        ];
    }
}
