<?php

namespace App\Orchid\Screens\Crop;

use App\Actions\Crop\DeleteCrop;
use App\Helpers\InsightsHelper;
use App\Models\Crop\Crop;
use App\Orchid\Layouts\Crop\CropListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
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

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.crops.create'),
            InsightsHelper::makeLink('crop'),
        ];
    }

    public function layout(): array
    {
        return [
            CropListLayout::class,
        ];
    }

    public function remove(Crop $crop): RedirectResponse
    {
        return DeleteCrop::runOrchidAction($crop, null);
    }
}
