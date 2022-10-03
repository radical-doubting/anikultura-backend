<?php

namespace App\Orchid\Screens\User\BigBrother;

use App\Actions\User\BigBrother\DeleteBigBrother;
use App\Models\User\BigBrother\BigBrother;
use App\Orchid\Layouts\User\BigBrother\BigBrotherFiltersLayout;
use App\Orchid\Layouts\User\BigBrother\BigBrotherListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Link;

class BigBrotherListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Big Brothers');
    }

    public function query(): array
    {
        return [
            'big_brothers' => BigBrother::filters()
                ->filtersApplySelection(BigBrotherFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.big-brothers.create'),

        ];
    }

    public function layout(): array
    {
        return [
            BigBrotherFiltersLayout::class,
            BigBrotherListLayout::class,
        ];
    }

    public function remove(BigBrother $bigBrother): RedirectResponse
    {
        return DeleteBigBrother::runOrchidAction($bigBrother, null);
    }
}
