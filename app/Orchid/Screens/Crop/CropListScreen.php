<?php

namespace App\Orchid\Screens\Crop;

use App\Actions\Crop\DeleteCrop;
use App\Models\Crop;
use App\Orchid\Layouts\Crop\CropListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CropListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Crop Types';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all crop types under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'crops' => Crop::filters()
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
                ->route('platform.crops.create'),

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
            CropListLayout::class,
        ];
    }

    /**
     * Remove a crop.
     *
     * @param Crop $crop
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Crop $crop)
    {
        return DeleteCrop::runOrchidAction($crop, null);
    }
}
