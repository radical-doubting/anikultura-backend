<?php

namespace Database\Seeders\Site;

use App\Models\Site\Province;
use App\Models\Site\Region;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            [
                'name' => 'Batangas',
                'region_id' => $this->getRegionId('Calabarzon'),
            ],
            [
                'name' => 'Isabela',
                'region_id' => $this->getRegionId('Cagayan Valley'),
            ],
            [
                'name' => 'Laguna',
                'region_id' => $this->getRegionId('Calabarzon'),
            ],
            [
                'name' => 'Pampanga',
                'region_id' => $this->getRegionId('Central Luzon'),
            ],
            [
                'name' => 'Iloilo',
                'region_id' => $this->getRegionId('Western Visayas'),
            ],
            [
                'name' => 'Pangasinan',
                'region_id' => $this->getRegionId('Ilocos Region'),
            ],
            [
                'name' => 'Bohol',
                'region_id' => $this->getRegionId('Central Visayas'),
            ],
            [
                'name' => 'Bulacan',
                'region_id' => $this->getRegionId('Central Luzon'),
            ],
            [
                'name' => 'Capiz',
                'region_id' => $this->getRegionId('Western Visayas'),
            ],
            [
                'name' => 'Masbate',
                'region_id' => $this->getRegionId('Bicol Region'),
            ],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }

    private function getRegionId(string $name): int
    {
        return Region::firstWhere(
            'name',
            $name
        )->id;
    }
}
