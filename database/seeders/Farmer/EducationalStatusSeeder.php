<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\EducationalStatus;
use Illuminate\Database\Seeder;

class EducationalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Elementary'],
            ['name' => 'High School'],
            ['name' => 'College'],
        ];

        foreach ($statuses as $status) {
            EducationalStatus::create($status);
        }
    }
}
