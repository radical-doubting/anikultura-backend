<?php

namespace App\Orchid\Screens\BigBrother;

use App\Actions\BigBrother\DeleteBigBrother;
use App\Models\BigBrother\BigBrother;
use App\Orchid\Layouts\BigBrother\BigBrotherListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Link;

class BigBrotherListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Batches');
    }

    public function query(): array
    {
        return [
            'big_brothers' => BigBrother::filters()
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
            BigBrotherListLayout::class,
        ];
    }

    public function remove(BigBrother $bigBrother): RedirectResponse
    {
        return DeleteBigBrother::runOrchidAction($bigBrother, null);
    }
}
