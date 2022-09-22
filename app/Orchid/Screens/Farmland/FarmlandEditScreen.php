<?php

namespace App\Orchid\Screens\Farmland;

use App\Actions\Farmland\CreateFarmland;
use App\Actions\Farmland\DeleteFarmland;
use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\Farmland\FarmlandEditBasicLayout;
use App\Orchid\Layouts\Farmland\FarmlandEditMemberLayout;
use App\Orchid\Layouts\Farmland\FarmlandEditOtherLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class FarmlandEditScreen extends AnikulturaEditScreen
{
    public Farmland $farmland;

    public function resourceName(): string
    {
        return __('farmland');
    }

    public function exists(): bool
    {
        return $this->farmland->exists;
    }

    public function query(Farmland $farmland): array
    {
        return [
            'farmland' => $farmland,
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(FarmlandEditBasicLayout::class)
                ->title(__('Basic Information'))
                ->description(__('This information collects farmlands basic information')),

            Layout::block(FarmlandEditMemberLayout::class)
                ->title(__('Farmers'))
                ->description(_('This information assigns the farmers to this farmland')),

            Layout::block(FarmlandEditOtherLayout::class)
                ->title(__('Other Information'))
                ->description(__('This information collects other farmland information'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    public function save(Farmland $farmland, Request $request): RedirectResponse
    {
        return CreateFarmland::runOrchidAction($farmland, $request);
    }

    public function remove(Farmland $farmland): RedirectResponse
    {
        return DeleteFarmland::runOrchidAction($farmland, null);
    }
}
