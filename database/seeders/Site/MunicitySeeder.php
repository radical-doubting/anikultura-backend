<?php

namespace Database\Seeders\Site;

use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use Illuminate\Database\Seeder;

class MunicitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $municities = [
            [
                'name' => 'Lobo',
                'province_id' => $this->getProvinceId('Batangas'),
                'region_id' => $this->getRegionId('Calabarzon'),
            ],
            [
                'name' => 'Luna',
                'province_id' => $this->getProvinceId('Isabela'),
                'region_id' => $this->getRegionId('Cagayan Valley'),
            ],
            [
                'name' => 'Lusiana',
                'province_id' => $this->getProvinceId('Laguna'),
                'region_id' => $this->getRegionId('Calabarzon'),
            ],
            [
                'name' => 'Mabalacat',
                'province_id' => $this->getProvinceId('Pampanga'),
                'region_id' => $this->getRegionId('Central Luzon'),
            ],
            [
                'name' => 'San Joaquin',
                'province_id' => $this->getProvinceId('Iloilo'),
                'region_id' => $this->getRegionId('Western Visayas'),
            ],
            [
                'name' => 'Mapandan',
                'province_id' => $this->getProvinceId('Pangasinan'),
                'region_id' => $this->getRegionId('Ilocos Region'),
            ],
            [
                'name' => 'Panglao',
                'province_id' => $this->getProvinceId('Bohol'),
                'region_id' => $this->getRegionId('Central Visayas'),
            ],
            [
                'name' => 'San Rafael',
                'province_id' => $this->getProvinceId('Bulacan'),
                'region_id' => $this->getRegionId('Central Luzon'),
            ],
            [
                'name' => 'Panay',
                'province_id' => $this->getProvinceId('Capiz'),
                'region_id' => $this->getRegionId('Western Visayas'),
            ],
            [
                'name' => 'Monreal',
                'province_id' => $this->getProvinceId('Masbate'),
                'region_id' => $this->getRegionId('Bicol Region'),
            ],
        ];

        foreach ($municities as $municity) {
            Municity::create($municity);
        }
    }

    private function getRegionId(string $name): int
    {
        return Region::firstWhere(
            'name',
            $name
        )->id;
    }

    private function getProvinceId(string $name): int
    {
        return Province::firstWhere(
            'name',
            $name
        )->id;
    }
}
