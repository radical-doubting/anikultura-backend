<?php

namespace App\Orchid\Screens\Farmland;

use App\Orchid\Layouts\Farmland\FarmlandListLayout;
use App\Models\Farmland\Farmland;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class FarmlandListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmlands';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all farmland under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmlands' => Farmland::filters()
                ->defaultSort('id')
                ->paginate()
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
                ->route('platform.farmer.farmland.create'),
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
            FarmlandListLayout::class
        ];
    }

    /**
     * @param Farmland $farmland
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function remove(Farmland $farmland)
    {
        $farmland->delete();

        Toast::info(__("Farmer's Farmland was removed successfully"));

        return redirect()->route('platform.farmer.farmland.view.all');
    }
}
