<?php

namespace App\Orchid\Layouts\User\Farmer;

use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class FarmerListFarmlandLayout extends AnikulturaListLayout
{
    protected $target = 'farmlands';

    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->cantHide()
                ->render(function (Farmland $farmland) {
                    return Link::make($farmland->name)
                        ->route('platform.farmlands.edit', [$farmland->id]);
                }),
        ];
    }
}
