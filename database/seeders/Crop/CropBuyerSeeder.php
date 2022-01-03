<?php

namespace Database\Seeders\Crop;

use App\Models\Farmland\CropBuyer;
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
        $cropBuyers = [
            ['name' => 'Biyahedor'],
            ['name' => 'Dizon Farm'],
            ['name' => 'Wholesaler'],
            ['name' => 'Market'],
            ['name' => 'FCA'],
        ];

        foreach ($cropBuyers as $cropBuyer) {
            CropBuyer::create($cropBuyer);
        }
    }
}
