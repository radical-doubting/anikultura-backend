<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRoleId = Role::where('slug', 'admin')
            ->first()
            ->id;

        Admin::factory()
            ->count(1)
            ->create()
            ->each(function (Admin $admin) use ($adminRoleId) {
                $admin->roles()->attach($adminRoleId);
            });
    }
}
