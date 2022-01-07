<?php

namespace App\Orchid\Screens\Farmland;

use App\Actions\Farmland\CreateFarmland;
use App\Actions\Farmland\DeleteFarmland;
use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\Farmland\FarmlandEditFarmLayout;
use App\Orchid\Layouts\Farmland\FarmlandEditMemberLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

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
            'farmland' => $farmland,
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
                ->description('This information collects farmlands basic information.'),

            Layout::block(FarmlandEditMemberLayout::class)
                ->title('Farmers')
                ->description('This information assigns the farmers to this farmland.'),
        ];
    }

    /**
     * Save a farmland.
     *
     * @param Farmland    $farmland
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Farmland $farmland, Request $request)
    {
        return CreateFarmland::runOrchidAction($farmland, $request);
    }

    /**
     * Remove a farmland.
     *
     * @param Farmland $farmland
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Farmland $farmland)
    {
        return DeleteFarmland::runOrchidAction($farmland, null);
    }
}
