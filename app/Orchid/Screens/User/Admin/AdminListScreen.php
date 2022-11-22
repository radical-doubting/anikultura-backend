<?php

namespace App\Orchid\Screens\User\Admin;

use App\Actions\User\Admin\DeleteAdmin;
use App\Models\User\Admin\Admin;
use App\Orchid\Layouts\User\Admin\AdminFiltersLayout;
use App\Orchid\Layouts\User\Admin\AdminListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;

class AdminListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Administrators');
    }

    public function query(): array
    {
        $this->authorize('viewAny', Admin::class);

        return [
            'admin' => Admin::filters()
                ->filtersApplySelection(AdminFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.admins.create'),

        ];
    }

    public function layout(): array
    {
        return [
            AdminFiltersLayout::class,
            AdminListLayout::class,
        ];
    }

    public function remove(Admin $admin, Request $request): RedirectResponse
    {
        return DeleteAdmin::runOrchidAction($admin, $request);
    }
}
