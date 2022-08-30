<?php

namespace Tests\Feature\Orchid\Screens\Site\Municity;

use App\Models\Admin\Admin;
use App\Models\Site\Municity;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Site\ProvinceSeeder;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchid\Support\Testing\ScreenTesting;
use Tests\TestCase;

class MunicityEditScreenTest extends TestCase
{
    use RefreshDatabase, ScreenTesting;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            RoleSeeder::class,
            AdminSeeder::class,
            AdminProfileSeeder::class,
            RegionSeeder::class,
            ProvinceSeeder::class,
        ]);
    }

    public function testShouldShowCreateScreen(): void
    {
        $screen = $this->screen('platform.sites.municities.create')->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Create'))
            ->assertSee(__('Municipality or City Information'))
            ->assertSee(__('Save'));
    }

    public function testShouldShowEditScreen(): void
    {
        $municity = Municity::factory()->count(1)->create()[0];

        $screen = $this->screen('platform.sites.municities.edit')
            ->parameters([$municity->id])
            ->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Edit Municipality or City'))
            ->assertSee(__('Remove'))
            ->assertSee(__('Save'));
    }
}
