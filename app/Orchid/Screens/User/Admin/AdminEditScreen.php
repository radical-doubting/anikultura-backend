<?php

namespace App\Orchid\Screens\User\Admin;

use App\Actions\User\Admin\CreateAdmin;
use App\Actions\User\Admin\DeleteAdmin;
use App\Models\User\Admin\Admin;
use App\Models\User\Admin\AdminProfile;
use App\Orchid\Layouts\User\Admin\AdminEditAccountLayout;
use App\Orchid\Layouts\User\Admin\AdminEditProfileLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class AdminEditScreen extends AnikulturaEditScreen
{
    public Admin $admin;

    public ?AdminProfile $adminProfile;

    public function resourceName(): string
    {
        return __('administrator');
    }

    public function exists(): bool
    {
        return $this->admin->exists;
    }

    public function query(Admin $admin): array
    {
        return [
            'admin' => $admin,
            'adminProfile' => $admin->profile,
        ];
    }

    public function layout(): iterable
    {
        $tabs = [
            __('Account Information') => [
                Layout::block(AdminEditAccountLayout::class)
                    ->title(__('Account Information'))
                    ->description(__('This information collects administrator\'s account information.'))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->method('save')
                    ),
            ],

            __('Profile Information') => [
                Layout::block(AdminEditProfileLayout::class)
                    ->title(__('Personal Information'))
                    ->description(__('Update administrator\'s  information'))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->method('save')
                    ),
            ],
        ];

        return [
            Layout::tabs($tabs)->activeTab(__('Account Information')),
        ];
    }

    public function remove(Admin $admin): RedirectResponse
    {
        return DeleteAdmin::runOrchidAction($admin, null);
    }

    public function save(Admin $admin, Request $request): RedirectResponse
    {
        return CreateAdmin::runOrchidAction($admin, $request);
    }
}
