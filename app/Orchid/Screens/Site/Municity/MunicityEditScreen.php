<?php

namespace App\Orchid\Screens\Site\Municity;

use App\Actions\Site\Municity\CreateMunicity;
use App\Actions\Site\Municity\DeleteMunicity;
use App\Models\Site\Municity;
use App\Orchid\Layouts\Site\Municity\MunicityListenerLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class MunicityEditScreen extends AnikulturaEditScreen
{
    public Municity $municity;

    public function resourceName(): string
    {
        return __('municipality or city');
    }

    public function exists(): bool
    {
        return $this->municity->exists;
    }

    public function query(Municity $municity): array
    {
        return [
            'municity' => $municity,
        ];
    }

    public function remove(Municity $municity): RedirectResponse
    {
        return DeleteMunicity::runOrchidAction($municity, null);
    }

    public function save(Municity $municity, Request $request): RedirectResponse
    {
        return CreateMunicity::runOrchidAction($municity, $request);
    }

    public function asyncGetRegionId(int $regionId = null)
    {
        return [
            'regionId' => $regionId,
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(MunicityListenerLayout::class)
                ->title(__('Municipality or City Information'))
                ->description(__('Update the municipality or city\'s details.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }
}
