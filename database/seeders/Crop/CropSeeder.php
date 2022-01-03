<?php

namespace Database\Seeders\Crop;

use App\Models\Crop;
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
                'establishment_days' => 10,
                'vegetative_days' => 15,
                'yield_formation_days' => 30,
                'ripening_days' => 10
            ]
        ];

        foreach ($crops as $crop) {
            Crop::create($crop);
        }
    }
}
