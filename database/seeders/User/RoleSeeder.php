<?php

namespace Database\Seeders\User;

use App\Models\User\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'slug' => 'admin',
                'name' => 'Administrator',
                'permissions' => [
                    'platform.index' => 1,
                    'platform.roles' => 1,
                    'platform.systems.attachment' => 1,
                    'platform.systems.settings' => 1,
                    'platform.sites.read' => 1,
                    'platform.sites.edit' => 1,
                    'platform.admins.read' => 1,
                    'platform.admins.edit' => 1,
                    'platform.big-brothers.read' => 1,
                    'platform.big-brothers.edit' => 1,
                    'platform.farmers.read' => 1,
                    'platform.farmers.edit' => 1,
                    'platform.farmlands.read' => 1,
                    'platform.farmlands.edit' => 1,
                    'platform.batches.read' => 1,
                    'platform.batches.edit' => 1,
                    'platform.batch-seed-allocations.read' => 1,
                    'platform.batch-seed-allocations.edit' => 1,
                    'platform.crops.read' => 1,
                    'platform.crops.edit' => 1,
                    'platform.farmer-reports.read' => 1,
                    'platform.farmer-reports.edit' => 1,
                ],
            ],
            [
                'slug' => 'big-brother',
                'name' => 'Big Brother',
                'permissions' => [
                    'platform.index' => 1,
                    'platform.systems.attachment' => 1,
                    'platform.systems.settings' => 1,
                    'platform.farmers.read' => 1,
                    'platform.farmers.edit' => 1,
                    'platform.farmlands.read' => 1,
                    'platform.farmlands.edit' => 1,
                    'platform.batches.read' => 1,
                    'platform.batches.edit' => 1,
                    'platform.batch-seed-allocations.read' => 1,
                    'platform.batch-seed-allocations.edit' => 1,
                    'platform.farmer-reports.read' => 1,
                    'platform.farmer-reports.edit' => 1,
                ],
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
