<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\CivilStatus;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Single'],
            ['name' => 'Married'],
            ['name' => 'Widow'],
            ['name' => 'Annuled'],
            ['name' => 'Separated'],
        ];

        foreach ($statuses as $status) {
            CivilStatus::create($status);
        }
    }
}
