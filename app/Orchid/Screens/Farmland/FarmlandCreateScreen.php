<?php

namespace App\Orchid\Screens\Farmland;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\Farmland\FarmlandCreateFarmLayout;
use App\Orchid\Layouts\Farmland\FarmlandCreateAddressLayout;
use App\Models\Farmer\Farmer_profile;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class FarmlandCreateScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create Farmland';

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
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
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
                ->title('Farmland Information')
                ->description('Insert Description.'),
            Layout::block(FarmlandCreateFarmLayout::class)
                ->title('Farmland Information')
                ->description('Insert Description.'),
        ];
    }
}
