<?php

namespace App\Orchid\Screens\BigBrother;

use App\Actions\BigBrother\DeleteBigBrother;
use App\Models\BigBrother\BigBrother;
use App\Orchid\Layouts\BigBrother\BigBrotherListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BigBrotherListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Big Brothers';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all big brothers under SM KSK SAP';

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
     * @param BigBrother $bigBrother
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(BigBrother $bigBrother)
    {
        return DeleteBigBrother::runOrchidAction($bigBrother, null);
    }
}
