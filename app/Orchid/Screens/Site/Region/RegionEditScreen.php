<?php

namespace App\Orchid\Screens\Site\Region;

use App\Actions\Site\Region\CreateRegion;
use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;
use App\Orchid\Layouts\Site\Region\RegionEditLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class RegionEditScreen extends AnikulturaEditScreen
{
    public Region $region;

    public function resourceName(): string
    {
        return __('region');
    }

    public function exists(): bool
    {
        return $this->region->exists;
    }

    public function query(Region $region): array
    {
        $this->authorize('view', $region);

        return [
            'region' => $region,
        ];
    }

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

    public function remove(Region $region, Request $request): RedirectResponse
    {
        return DeleteRegion::runOrchidAction($region, $request);
    }

    public function save(Region $region, Request $request): RedirectResponse
    {
        return CreateRegion::runOrchidAction($region, $request);
    }
}
