<?php

namespace Database\Factories\BigBrother;

use App\Models\BigBrother\BigBrother;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class BigBrotherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BigBrother::class;

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
        $username = strtolower($firstName);

        $data = [
            'name' => $username,
            'email' => "$username@smfi.ph",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'profile_type' => 'App\Models\BigBrother\BigBrotherProfile',
            'profile_id' => self::$nextProfileId++,
        ];

        return $data;
    }
}
