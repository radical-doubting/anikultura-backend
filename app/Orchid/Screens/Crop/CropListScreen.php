<?php

namespace App\Orchid\Screens\Crop;

use App\Actions\Crop\DeleteCrop;
use App\Models\Crop\Crop;
use App\Orchid\Layouts\Crop\CropListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class CropListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Crop Types');
    }

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
     * @param  Crop  $crop
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Crop $crop)
    {
        return DeleteCrop::runOrchidAction($crop, null);
    }
}
