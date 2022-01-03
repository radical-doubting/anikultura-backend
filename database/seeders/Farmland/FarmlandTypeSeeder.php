<?php

namespace Database\Seeders\Farmland;

use App\Models\Farmland\FarmlandType;
use Illuminate\Database\Seeder;

class FarmlandTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farmlandTypes = [
            ['name' => 'Community Farmland'],
            ['name' => 'Personal Farmland'],
        ];

        foreach ($farmlandTypes as $farmlandType) {
            FarmlandType::create($farmlandType);
        }
    }
}
