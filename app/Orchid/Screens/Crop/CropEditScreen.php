<?php

namespace App\Orchid\Screens\Crop;

use App\Actions\Crop\CreateCrop;
use App\Actions\Crop\DeleteCrop;
use App\Models\Crop\Crop;
use App\Orchid\Layouts\Crop\CropEditBasicLayout;
use App\Orchid\Layouts\Crop\CropEditGrowthLayout;
use App\Orchid\Layouts\Crop\CropEditPriceLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class CropEditScreen extends AnikulturaEditScreen
{
    public Crop $crop;

    public function resourceName(): string
    {
        return __('crop type');
    }

    public function exists(): bool
    {
        return $this->crop->exists;
    }

    public function query(Crop $crop): array
    {
        return [
            'crop' => $crop,
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(CropEditBasicLayout::class)
                ->title(__('Basic Information'))
                ->description(__('Update your crop\'s basic information')),

            Layout::block(CropEditPriceLayout::class)
                ->title(__('Price Information'))
                ->description(__('Update your crop\'s price information')),

            Layout::block(CropEditGrowthLayout::class)
                ->title(__('Growth Information'))
                ->description(__('Update your crop growth rate information'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    public function remove(Crop $crop): RedirectResponse
    {
        return DeleteCrop::runOrchidAction($crop, null);
    }

    public function save(Crop $crop, Request $request): RedirectResponse
    {
        return CreateCrop::runOrchidAction($crop, $request);
    }
}
