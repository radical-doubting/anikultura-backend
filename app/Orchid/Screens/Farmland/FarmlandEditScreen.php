<?php

namespace App\Orchid\Screens\Farmland;

use Illuminate\Http\Request;
use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\Farmland\FarmlandEditFarmLayout;
use App\Orchid\Layouts\Farmland\FarmlandEditAddressLayout;
use App\Orchid\Layouts\Farmland\FarmlandEditAppStatusLayout;
use App\Orchid\Layouts\Farmland\FarmlandEditMemberLayout;
use Illuminate\Support\Facades\Log;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Action;

class FarmlandEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */

    public $name = 'Edit Farmland';

    /**
     * Display header description.
     *
     * @var string|null
     */

    public $description = 'Edit farmland details';

    /**
     * Query data.
     *
     * @return array
     */

    public function query(Farmland $farmland): array
    {
        $this->farmland = $farmland;

        if (!$farmland->exists) {
            $this->name = 'Create Farmland';
            $this->description = 'Create a new farmland';
        }

        return [
            'farmland' => $farmland
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
                ->confirm(__('Once the farmer farmland is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->farmland->exists),

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
            Layout::block(FarmlandEditFarmLayout::class)
                ->title('Basic Information')
                ->description("This information collects farmlands basic information."),

            Layout::block(FarmlandEditMemberLayout::class)
                ->title('Farmers')
                ->description('This information assigns the farmers to this farmland.'),
        ];
    }

    /**
     * @param Farmland    $farmland
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function save(Farmland $farmland, Request $request)
    {
        $request->validate([
            'farmland.type_id' => [
                'required'
            ],
            'farmland.status_id' => [
                'required'
            ],
            'farmland.hectares_size' => [
                'required'
            ],
            'farmland.watering_systems' => [
                'required',
                'array'
            ],
            'farmland.crop_buyers' => [
                'required',
                'array'
            ],
            'farmland.farmers' => [
                'required',
                'array'
            ],
        ]);

        $farmland_data = $request->get('farmland');

        $farmland
            ->fill($farmland_data)
            ->save();

        $farmland
            ->watering_systems()
            ->sync($farmland_data['watering_systems']);

        $farmland
            ->crop_buyers()
            ->sync($farmland_data['crop_buyers']);

        $farmland
            ->farmers()
            ->sync($farmland_data['farmers']);

        Toast::info(__('Farmland was saved'));

        return redirect()->route('platform.farmer.farmland.view.all');
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
