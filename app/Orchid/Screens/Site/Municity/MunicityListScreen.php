<?php

namespace App\Orchid\Screens\Site\Municity;

use App\Models\Site\Municity;
use App\Orchid\Layouts\Site\Municity\MunicityListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class MunicityListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Municipalities and Cities';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all municipalities and cities under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'municities' => Municity::with('region')
                ->with('province')
                ->filters()
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
                ->route('platform.sites.municities.create'),
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
            MunicityListLayout::class,
        ];
    }

    /**
     * @param Municity $municity
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Municity $municity)
    {
        $municity->delete();

        Toast::info(__('Municity was removed successfully'));

        return redirect()->route('platform.sites.municities');
    }
}
