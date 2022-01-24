<?php

namespace Database\Seeders\Site;

use App\Models\Site\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ['name' => 'National Capital Region', 'short_name' => 'NCR'],
            ['name' => 'Cordillera Administrative Region', 'short_name' => 'CAR'],
            ['name' => 'Ilocos Region', 'short_name' => 'Region I'],
            ['name' => 'Cagayan Valley', 'short_name' => 'Region II'],
            ['name' => 'Central Luzon', 'short_name' => 'Region III'],
            ['name' => 'Calabarzon', 'short_name' => 'Region IV-A'],
            ['name' => 'Mimaropa', 'short_name' => 'Region IV-B'],
            ['name' => 'Bicol Region', 'short_name' => 'Region V'],
            ['name' => 'Western Visayas', 'short_name' => 'Region VI'],
            ['name' => 'Central Visayas', 'short_name' => 'Region VII'],
            ['name' => 'Eastern Visayas', 'short_name' => 'Region VIII'],
            ['name' => 'Zamboanga Peninsula', 'short_name' => 'Region IX'],
            ['name' => 'Northern Mindanao', 'short_name' => 'Region X'],
            ['name' => 'Davao Region', 'short_name' => 'Region XI'],
            ['name' => 'Soccsksargen', 'short_name' => 'Region XII'],
            ['name' => 'Caraga', 'short_name' => 'Region XIII'],
            ['name' => 'Bangsamoro', 'short_name' => 'BARMM'],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
