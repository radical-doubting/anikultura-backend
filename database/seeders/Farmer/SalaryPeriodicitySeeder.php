<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\SalaryPeriodicity;
use Illuminate\Database\Seeder;

class SalaryPeriodicitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodicities = [
            ['name' => 'Everyday'],
            ['name' => 'Monthly'],
            ['name' => 'Annually'],
            ['name' => 'Every 15 days'],
            ['name' => 'Every 3 months'],
            ['name' => 'Every 6 months'],
        ];

        foreach ($periodicities as $periodicity) {
            SalaryPeriodicity::create($periodicity);
        }
    }
}
