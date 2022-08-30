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

class RegionEditScreenTest extends TestCase
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

    public function testShouldShowCreateScreen(): void
    {
        $screen = $this->screen('platform.sites.regions.create')->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Create'))
            ->assertSee(__('Region Information'))
            ->assertSee(__('Save'));
    }

    public function testShouldShowEditScreen(): void
    {
        $region = Region::create([
            'name' => 'National Capital Region',
            'short_name' => 'NCR',
        ]);

        $screen = $this->screen('platform.sites.regions.edit')
            ->parameters([$region->id])
            ->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Edit region'))
            ->assertSee(__('Remove'))
            ->assertSee(__('Save'));
    }
}
