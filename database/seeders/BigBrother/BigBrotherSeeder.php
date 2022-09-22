<?php

namespace Database\Seeders\BigBrother;

use App\Models\BigBrother\BigBrother;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

class BigBrotherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bigBrotherRoleId = Role::where('slug', 'big-brother')
            ->first()
            ->id;

        BigBrother::factory()
            ->count(10)
            ->sequence(fn (Sequence $sequence) => [
                'profile_id' => $sequence->index + 1,
            ])
            ->create()
            ->each(function (BigBrother $bigBrother) use ($bigBrotherRoleId) {
                $bigBrother->roles()->attach($bigBrotherRoleId);
            });
    }
}
