<?php

namespace App\Orchid\Layouts\User\Admin;

use App\Models\User\Admin\Admin;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\TD;

class AdminListLayout extends AnikulturaListLayout
{
    protected $target = 'admin';

    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->render(function (Admin $admin) {
                    return new Persona($admin->presenter());
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Admin $admin) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.admins.edit', [$admin->id])
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the administrator is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $admin->id,
                                ]),
                        ]);
                }),
        ];
    }
}
