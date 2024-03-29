<?php

namespace Database\Seeders\User\Admin;

use App\Models\User\Admin\Admin;
use App\Models\User\Admin\AdminProfile;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminProfileSeeder::class,
        ]);

        $profiles = AdminProfile::all();

        $adminRoleId = Role::admin()->id;

        Admin::factory()
            ->count(1)
            ->sequence(fn (Sequence $sequence) => [
                'profile_id' => $profiles->get($sequence->index),
            ])
            ->create()
            ->each(
                fn (Admin $admin) => $admin->roles()->attach($adminRoleId)
            );
    }
}
