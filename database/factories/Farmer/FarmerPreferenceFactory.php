<?php

namespace Database\Factories\Farmer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farmer\FarmerPreference>
 */
class FarmerPreferenceFactory extends Factory
{
    private static $nextProfileId = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'farmer_profile_id' => self::$nextProfileId++,
            'tutorial_done' => false,
            'language' => 'en',
        ];
    }
}
