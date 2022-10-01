<?php

namespace Database\Seeders;

use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use Database\Seeders\FarmerReport\FarmerReportSeeder;
use Database\Seeders\Farmland\FarmlandSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SiteSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(FarmerSeeder::class);
        $this->call(BigBrotherSeeder::class);
        $this->call(AdminSeeder::class);

        $this->call(CropSeeder::class);
        $this->call(BatchSeeder::class);
        $this->call(FarmlandSeeder::class);
        $this->call(FarmerReportSeeder::class);
    }
}
