<?php

namespace Database\Seeders\Farmer;

use App\Models\User\Farmer\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            ['name' => 'Male'],
            ['name' => 'Female'],
            ['name' => 'Unspecified'],
        ];

        foreach ($genders as $gender) {
            Gender::create($gender);
        }
    }
}
