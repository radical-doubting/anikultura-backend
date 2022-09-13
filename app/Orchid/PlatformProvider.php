<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param  Dashboard  $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Site Management')
                ->icon('organization')
                ->title('Navigation')
                ->list([
                    Menu::make('Regions')
                        ->icon('location-pin')
                        ->route('platform.sites.regions'),
                    Menu::make('Provinces')
                        ->icon('location-pin')
                        ->route('platform.sites.provinces'),
                    Menu::make('Municipalities and Cities')
                        ->icon('location-pin')
                        ->route('platform.sites.municities'),
                ])
                ->permission('platform.sites.read'),
            Menu::make('Farmer Management')
                ->icon('people')
                ->list([
                    Menu::make('Big Brothers')
                        ->icon('graduation')
                        ->route('platform.big-brothers')
                        ->permission('platform.big-brothers.read'),
                    Menu::make('Farmers')
                        ->icon('user')
                        ->route('platform.farmers')
                        ->permission('platform.farmers.read'),
                    Menu::make('Farmlands')
                        ->icon('full-screen')
                        ->route('platform.farmlands')
                        ->permission('platform.farmlands.read'),
                    Menu::make('Batches')
                        ->icon('module')
                        ->route('platform.batches')
                        ->permission('platform.batches.read'),
                ]),

            Menu::make('Crop Types Management')
                ->icon('quote')
                ->route('platform.crops')
                ->permission('platform.crops.read'),

            Menu::make('Farmer Reports Management')
                ->icon('docs')
                ->route('platform.farmer-reports')
                ->permission('platform.farmer-reports.read'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make('Language')
                ->icon('refresh')
                ->list([
                    Menu::make('English')
                        ->icon('location-pin')
                        ->route('lang.switch', ['lang' => 'en']),
                    Menu::make('Tagalog')
                        ->icon('location-pin')
                        ->route('lang.switch', ['lang' => 'fil_PH']),
                ]),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
            ItemPermission::group(__('Sites'))
                ->addPermission('platform.sites.read', __('Read Sites'))
                ->addPermission('platform.sites.edit', __('Edit Sites')),
            ItemPermission::group(__('Big Brothers'))
                ->addPermission('platform.big-brothers.read', __('Read Big Brothers'))
                ->addPermission('platform.big-brothers.edit', __('Edit Big Brothers')),
            ItemPermission::group(__('Farmers'))
                ->addPermission('platform.farmers.read', __('Read Farmers'))
                ->addPermission('platform.farmers.edit', __('Edit Farmers')),
            ItemPermission::group(__('Farmlands'))
                ->addPermission('platform.farmlands.read', __('Read Farmlands'))
                ->addPermission('platform.farmlands.edit', __('Edit Farmlands')),
            ItemPermission::group(__('Batches'))
                ->addPermission('platform.batches.read', __('Read Batches'))
                ->addPermission('platform.batches.edit', __('Edit Batches'))
                ->addPermission('platform.batch-seed-allocations.read', __('Read Batch Seed Allocations'))
                ->addPermission('platform.batch-seed-allocations.edit', __('Edit Batch Seed Allocations')),
            ItemPermission::group(__('Crop Types'))
                ->addPermission('platform.crops.read', __('Read Crop Types'))
                ->addPermission('platform.crops.edit', __('Edit Crop Types')),
            ItemPermission::group(__('Farmer Reports'))
                ->addPermission('platform.farmer-reports.read', __('Read Farmer Reports'))
                ->addPermission('platform.farmer-reports.edit', __('Edit Farmer Reports')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
