<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Admin;
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

    private static $nextProfileId = 1;

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
            'email' => "$username@smfi.ph",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'profile_type' => 'App\Models\Admin\AdminProfile',
            'profile_id' => self::$nextProfileId++,
        ];

        return $data;
    }
}
