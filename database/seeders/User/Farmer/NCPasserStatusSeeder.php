<?php

namespace Database\Seeders\User\Farmer;

use App\Models\User\Farmer\NCPasserStatus;
use Illuminate\Database\Seeder;

class NCPasserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Passed'],
            ['name' => 'Failed'],
            ['name' => 'Unspecified'],
        ];

        foreach ($statuses as $status) {
            NCPasserStatus::create($status);
        }
    }
}
