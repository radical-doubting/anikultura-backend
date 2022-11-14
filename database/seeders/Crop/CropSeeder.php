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
        $this->call([
            SeedStageSeeder::class,
            CropBuyerSeeder::class,
        ]);

        $crops = [
            [
                'name' => 'Calamansi',
                'group' => 'Calamansi Group',
                'variety' => 'Calamansi Variety',
                'gross_returns_per_ha' => 151312,
                'total_costs_per_ha' => 81094,
                'production_cost_per_kg' => 14.69,
                'farmgate_price_per_kg' => 27.41,
                'yield_per_ha' => 5520,
                'maturity_lower_bound' => 90,
                'maturity_upper_bound' => 120,
            ],
        ];

        foreach ($crops as $crop) {
            Crop::create($crop);
        }
    }
}
