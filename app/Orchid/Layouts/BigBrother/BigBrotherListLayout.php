<?php

namespace App\Orchid\Layouts\BigBrother;

use App\Models\BigBrother\BigBrotherProfile;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BigBrotherListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'big_brothers';

    /**
     * @return bool
     */
    protected function striped(): bool
    {
        return true;
    }

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('firstname', __('First Name'))
                ->render(function (BigBrotherProfile $bigBrotherProfile) {
                    $user = $bigBrotherProfile->user;
                    $has_user = !is_null($user);
                    $element = $has_user ? Link::make($user->first_name)
                        ->route('platform.farmers.edit', $bigBrotherProfile->id) : __('None');

                    return $element;
                }),

            TD::make('middlename', __('Middle Name'))
                ->render(function (BigBrotherProfile $bigBrotherProfile) {
                    $user = $bigBrotherProfile->user;
                    $has_user = !is_null($user);
                    $element = $has_user ? Link::make($user->middle_name)
                        ->route('platform.farmers.edit', $bigBrotherProfile->id) : __('None');

                    return $element;
                }),

            TD::make('lastname', __('Last Name'))
                ->cantHide()
                ->render(function (BigBrotherProfile $bigBrotherProfile) {
                    $user = $bigBrotherProfile->user;
                    $has_user = !is_null($user);
                    $element = $has_user ? Link::make($user->last_name)
                        ->route('platform.farmers.edit', $bigBrotherProfile->id) : __('None');

                    return $element;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (BigBrotherProfile $bigBrotherProfile) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.farmers.edit', $bigBrotherProfile->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the farmer profile is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $bigBrotherProfile->id,
                                ]),
                        ]);
                }),
        ];
    }
}
