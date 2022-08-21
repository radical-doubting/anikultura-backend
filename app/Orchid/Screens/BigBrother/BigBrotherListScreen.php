<?php

namespace App\Orchid\Screens\BigBrother;

use App\Actions\BigBrother\DeleteBigBrother;
use App\Models\BigBrother\BigBrother;
use App\Orchid\Layouts\BigBrother\BigBrotherListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class BigBrotherListScreen extends AnikulturaListScreen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Big Brothers';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'big_brothers' => BigBrother::filters()
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.big-brothers.create'),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            BigBrotherListLayout::class,
        ];
    }

    /**
     * Remove a big brother.
     *
     * @param  BigBrother  $bigBrother
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(BigBrother $bigBrother)
    {
        return DeleteBigBrother::runOrchidAction($bigBrother, null);
    }
}
