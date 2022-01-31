<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

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
                    'platform.sites.read' => true,
                    'platform.sites.edit' => true,
                    'platform.big-brothers.read' => true,
                    'platform.big-brothers.edit' => true,
                    'platform.farmers.read' => true,
                    'platform.farmers.edit' => true,
                    'platform.farmlands.read' => true,
                    'platform.farmlands.edit' => true,
                    'platform.batches.read' => true,
                    'platform.batches.edit' => true,
                    'platform.batch-seed-allocations.read' => true,
                    'platform.batch-seed-allocations.edit' => true,
                    'platform.crops.read' => true,
                    'platform.crops.edit' => true,
                    'platform.farmer-reports.read' => true,
                    'platform.farmer-reports.edit' => true,
                ],
            ],
            [
                'slug' => 'big-brother',
                'name' => 'Big Brother',
                'permissions' => [
                    'platform.farmlands.read' => true,
                    'platform.farmlands.edit' => true,
                    'platform.batches.read' => true,
                    'platform.batches.edit' => true,
                    'platform.batch-seed-allocations.read' => true,
                    'platform.batch-seed-allocations.edit' => true,
                    'platform.farmer-reports.read' => true,
                    'platform.farmer-reports.edit' => true,
                ],
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
