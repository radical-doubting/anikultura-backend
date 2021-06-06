<?php

namespace App\Orchid\Screens\Farmland;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\Farmland\FarmlandCreateFarmLayout;
use App\Orchid\Layouts\Farmland\FarmlandCreateAddressLayout;
use App\Orchid\Layouts\Farmland\FarmlandCreateAppStatusLayout;
use App\Models\Farmer\Farmer_profile;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class FarmlandEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */

    public $name = "Enroll Farmer's Farmland";

    /**
     * Display header description.
     *
     * @var string|null
     */

    public $description = 'Fill out all required information.';

    /**
     * Query data.
     *
     * @return array
     */

    public function query(Farmland $farmland): array
    {
        $this->farmland = $farmland;
        
        if (!$farmland->exists) {
            $this->name = "Enroll Farmer's Farmland";
            $this->description = "Enroll Farmer's Farmland";
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
            Layout::block(FarmlandCreateAddressLayout::class)
                ->title('Farmland Address')
                ->description('Insert Description.'),

            Layout::block(FarmlandCreateFarmLayout::class)
                ->title('Farmland Information')
                ->description('Insert Description.'),

            Layout::block(FarmlandCreateAppStatusLayout::class)
                ->title('Application Verification')
                ->description('Insert Description.'),
        ];
    }

    /**
     * @param Farmer_profile    $farmer_profile
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function save(Farmland $farmland, Request $request)
    {
        $request->validate([
            'farmland.farmland_status' => [
                'required'
            ],

            'farmland.farm_type' => [
                'required'
            ],

            'farmland.farm_size' => [
                'required'
            ],

            'farmland.watering_system_used' => [
                'required'
            ],

            'farmland.crop_buyer' => [
                'required'
            ]
        ]);

        $farmerprofileData = $request->get('farmer_profile');

        $farmer_profile
            ->fill($farmerprofileData)
            ->save();

        Toast::info(__('Farmer Profile was saved'));

        return redirect()->route('platform.farmer.profile.view.all');
    }
}
