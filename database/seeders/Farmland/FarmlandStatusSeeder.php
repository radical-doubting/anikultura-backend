<?php

namespace Database\Seeders\Farmland;

use App\Models\Farmland\FarmlandStatus;
use Illuminate\Database\Seeder;

class FarmlandStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farmlandStatuses = [
            ['name' => 'Owned'],
            ['name' => 'Rented'],
            ['name' => 'Borrowed'],
        ];

        foreach ($farmlandStatuses as $farmlandStatus) {
            FarmlandStatus::create($farmlandStatus);
        }
    }
}
