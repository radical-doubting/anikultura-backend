<?php

namespace Database\Seeders;

use App\Models\Farmland\FarmlandStatus;
use Carbon\Carbon;
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
        $date_now = Carbon::now();
        $regions = [
            ['id' => 1, 'name' => 'Owned', 'created_at' => $date_now],
            ['id' => 2, 'name' => 'Rented', 'created_at' => $date_now],
            ['id' => 3, 'name' => 'Borrowed', 'created_at' => $date_now],
        ];

        FarmlandStatus::insert($regions);
    }
}
