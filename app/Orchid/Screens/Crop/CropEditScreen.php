<?php

namespace App\Orchid\Screens\Crop;

use App\Models\Crop;
use App\Orchid\Layouts\Crop\CropEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

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

    //Delete function
    public function remove(Crop $crop)
    {
        $crop->delete();

        Toast::info(__('Crop was removed'));

        return redirect()->route('platform.crops');
    }

    //Save function
    public function save(Crop $crop, Request $request)
    {
        $request->validate([
            'crop.group' => [
                'required',
            ],
            'crop.name' => [
                'required',
            ],
            'crop.variety' => [
                'required',
            ],
            'crop.establishment_days' => [
                'required',
            ],
            'crop.vegetative_days' => [
                'required',
            ],
            'crop.yield_formation_days' => [
                'required',
            ],
            'crop.ripening_days' => [
                'required',
            ],
        ]);

        $crop_data = $request->get('crop');

        $crop
            ->fill($crop_data)
            ->save();

        Toast::info(__('Crop was saved.'));

        return redirect()->route('platform.crops');
    }
}
