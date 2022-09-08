<?php

namespace Tests\Feature\Orchid\Screens\Site\Province;

use App\Models\Admin\Admin;
use App\Models\Site\Province;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Site\RegionSeeder;
use Database\Seeders\User\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchid\Support\Testing\ScreenTesting;
use Tests\TestCase;

class ProvinceEditScreenTest extends TestCase
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
        ]);
    }

    public function testShouldShowCreateScreen(): void
    {
        $screen = $this->screen('platform.sites.provinces.create')->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Create'))
            ->assertSee(__('Province Information'))
            ->assertSee(__('Save'));
    }

    public function testShouldShowEditScreen(): void
    {
        $province = Province::factory()->count(1)->create()[0];

        $screen = $this->screen('platform.sites.provinces.edit')
            ->parameters([$province->id])
            ->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Edit province'))
            ->assertSee(__('Remove'))
            ->assertSee(__('Save'));
    }
}
