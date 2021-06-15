<?php

namespace Database\Seeders;

use App\Helpers\PostgresHelper;
use App\Models\Farmland\CropBuyer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CropBuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $crop_buyers = [
            ['id' => 1, 'name' => 'Biyahedor', 'created_at' => $date_now],
            ['id' => 2, 'name' => 'Dizon Farm', 'created_at' => $date_now],
            ['id' => 3, 'name' => 'Wholesaler', 'created_at' => $date_now],
            ['id' => 4, 'name' => 'Market', 'created_at' => $date_now],
            ['id' => 5, 'name' => 'FCA', 'created_at' => $date_now],
        ];

        CropBuyer::insert($crop_buyers);
        PostgresHelper::update_increments('crop_buyers');
    }
}
