<?php

namespace Tests\Feature\Orchid\Screens\Site\Province;

use App\Models\Admin\Admin;
use Database\Seeders\Admin\AdminProfileSeeder;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchid\Support\Testing\ScreenTesting;
use Tests\TestCase;

class ProvinceListScreenTest extends TestCase
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
        $screen = $this->screen('platform.sites.provinces')->actingAs(Admin::first());

        $screen->display()
            ->assertSee(__('Province'));
    }
}