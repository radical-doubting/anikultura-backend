<?php

namespace Database\Seeders\Crop;

use App\Models\Crop\Crop;
use Illuminate\Database\Seeder;

class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crops = [
            [
                'group' => 'Banana Group',
                'name' => 'Banana',
                'variety' => 'Banana Variety',
                'maturity_lower_bound' => 15,
                'maturity_upper_bound' => 30,
            ],
        ];

        foreach ($crops as $crop) {
            Crop::create($crop);
        }
    }
}
