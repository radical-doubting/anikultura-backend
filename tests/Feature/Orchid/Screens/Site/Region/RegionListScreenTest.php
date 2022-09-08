<?php

namespace Tests\Feature\Orchid\Screens\Site\Region;

use App\Models\Admin\Admin;
use App\Models\Site\Region;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchid\Support\Testing\ScreenTesting;
use Tests\TestCase;

class RegionListScreenTest extends TestCase
{
    use RefreshDatabase, ScreenTesting;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            RoleSeeder::class,
            AdminSeeder::class,
            AdminProfileSeeder::class,
        ]);
    }

    public function testShouldShowListScreen(): void
    {
        $screen = $this->screen('platform.sites.regions')->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Region'));
    }

    public function testShouldShowRegionInScreen(): void
    {
        Region::create([
            'name' => 'Some Example Region',
            'short_name' => 'SER',
        ]);

        $screen = $this->screen('platform.sites.regions')->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Some Example Region'))
            ->assertSee(__('SER'));
    }
}
