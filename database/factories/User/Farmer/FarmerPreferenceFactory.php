<?php

namespace Database\Factories\User\Farmer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\Farmer\FarmerPreference>
 */
class FarmerPreferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tutorial_done' => false,
        ];
    }
}
