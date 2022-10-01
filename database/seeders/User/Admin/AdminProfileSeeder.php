<?php

namespace Database\Seeders\Admin;

use App\Models\User\Admin\AdminProfile;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminProfile::factory()->count(1)->create();
    }
}
