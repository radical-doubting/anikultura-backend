<?php

namespace Database\Seeders\User\Farmer;

use App\Models\User\Farmer\SocialStatus;
use Illuminate\Database\Seeder;

class SocialStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Poor'],
            ['name' => 'Low-income but not poor'],
            ['name' => 'Lower-middle'],
            ['name' => 'Middle'],
            ['name' => 'Upper-middle'],
            ['name' => 'Upper-middle but not rich'],
            ['name' => 'Rich'],
        ];

        foreach ($statuses as $status) {
            SocialStatus::create($status);
        }
    }
}
