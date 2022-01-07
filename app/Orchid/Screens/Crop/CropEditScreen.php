<?php

namespace App\Orchid\Screens\Crop;

use App\Actions\Crop\CreateCrop;
use App\Actions\Crop\DeleteCrop;
use App\Models\Crop\Crop;
use App\Orchid\Layouts\Crop\CropEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class CropEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Crop';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit a crop type under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Crop $crop): array
    {
        $this->crop = $crop;

        if (!$crop->exists) {
            $this->name = 'Create Crop';
            $this->description = 'Create a new Crop Type';
        }

        return [
            'crop' => $crop,
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
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the crop type is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->crop->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),

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
            Layout::block(CropEditLayout::class)
                ->title(__('Crop Information'))
                ->description(__('Update your crop\'s  information'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->crop->exists)
                        ->method('save')
                ),
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

    /**
     * Save a crop.
     *
     * @param Crop    $crop
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Crop $crop, Request $request)
    {
        return CreateCrop::runOrchidAction($crop, $request);
    }
}
