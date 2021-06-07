<?php

namespace App\Orchid\Screens\Farmland;

use Illuminate\Http\Request;
use App\Models\Farmland;
use App\Orchid\Layouts\Farmland\FarmlandCreateFarmLayout;
use App\Orchid\Layouts\Farmland\FarmlandCreateAddressLayout;
use App\Orchid\Layouts\Farmland\FarmlandCreateAppStatusLayout;
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
            Layout::block(FarmlandCreateFarmLayout::class)
                ->title('Farmland Information')
                ->description('Insert Description.'),
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
            'farmland.hectares_size' => [
                'required'
            ],

        ]);

        $farmlandData = $request->get('farmland');

        $farmland
            ->fill($farmlandData)
            ->save();

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
