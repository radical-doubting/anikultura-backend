<?php

namespace App\Orchid\Screens\Site\Region;

use App\Actions\Site\Region\CreateRegion;
use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;
use App\Orchid\Layouts\Site\Region\RegionEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class RegionEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Region';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit region details';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Region $region): array
    {
        $this->region = $region;

        if (!$region->exists) {
            $this->name = 'Create Region';
            $this->description = 'Create a new region';
        }

        return [
            'region' => $region,
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
                ->confirm(__('Once the region is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->region->exists),

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
            Layout::block(RegionEditLayout::class)
                ->title(__('Region Information'))
                ->description(__('Update the region\'s details.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->region->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * Remove a region.
     *
     * @param Region $region
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Region $region)
    {
        return DeleteRegion::runOrchidAction($region, null);
    }

    /**
     * Save a region.
     *
     * @param Region  $region
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Region $region, Request $request)
    {
        return CreateRegion::runOrchidAction($region, $request);
    }
}
