<?php

namespace Database\Factories\User\Admin;

use App\Models\User\Admin\Admin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

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

        $data = [
            'name' => $username,
            'email' => "$username@smfi.ph",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'first_name' => $firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'profile_type' => Admin::PROFILE_PATH,
        ];

        return $data;
    }
}
