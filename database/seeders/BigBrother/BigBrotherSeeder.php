<?php

namespace Database\Seeders\BigBrother;

use App\Models\BigBrother\BigBrother;
use App\Models\BigBrother\BigBrotherProfile;
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
        $this->call([
            BigBrotherProfileSeeder::class,
        ]);

        $profiles = BigBrotherProfile::all();

        $bigBrotherRoleId = Role::where('slug', 'big-brother')
            ->first()
            ->id;

        BigBrother::factory()
            ->count(10)
            ->sequence(fn (Sequence $sequence) => [
                'profile_id' => $profiles->get($sequence->index),
            ])
            ->create()
            ->each(function (BigBrother $bigBrother) use ($bigBrotherRoleId) {
                $bigBrother->roles()->attach($bigBrotherRoleId);
            });
    }
}
