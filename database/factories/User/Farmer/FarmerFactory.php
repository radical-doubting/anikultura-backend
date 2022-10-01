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
        $firstName = $this->faker->unique()->firstName();
        $middleName = $this->faker->lastName();
        $lastName = $this->faker->lastName();
        $randomNumber = $this->faker->numberBetween(1, 99);
        $username = strtolower("$firstName$randomNumber");

        $data = [
            'name' => $username,
            'email' => "$username@gmail.com",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'profile_type' => 'App\Models\User\Farmer\FarmerProfile',
        ];

        return $data;
    }
}
