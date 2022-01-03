<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
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
                    Menu::make('Municities')
                        ->icon('location-pin')
                        ->route('platform.sites.municities'),
                ]),
            Menu::make('Farmer Management')
                ->icon('people')
                ->list([
                    Menu::make('Farmer Profiles')
                        ->icon('user')
                        ->route('platform.farmer.profile.view.all'),
                    Menu::make('Farmlands')
                        ->icon('full-screen')
                        ->route('platform.farmer.farmland.view.all'),
                    Menu::make('Batches')
                        ->icon('module')
                        ->route('platform.batches'),
                ]),

            Menu::make('Crop Type Management')
                ->icon('quote')
                ->route('platform.crops'),

            Menu::make('Farmer Report Management')
                ->icon('docs')
                ->title(__('Admin Insights'))
                ->route('platform.farmer.reports'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
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
