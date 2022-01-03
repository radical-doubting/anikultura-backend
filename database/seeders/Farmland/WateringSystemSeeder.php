<?php

namespace Database\Seeders\Farmland;

use App\Models\Farmland\WateringSystem;
use Illuminate\Database\Seeder;

class WateringSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wateringSystems = [
            ['name' => 'Well'],
            ['name' => 'NIA Canal / Irrigation'],
            ['name' => 'Spring'],
            ['name' => 'Shallow Tube Well'],
            ['name' => 'Creek'],
            ['name' => 'Faucet'],
            ['name' => 'Rain Water'],
        ];

        foreach ($wateringSystems as $wateringSystem) {
            WateringSystem::create($wateringSystem);
        }
    }
}
