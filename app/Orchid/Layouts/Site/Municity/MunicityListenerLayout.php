<?php

namespace App\Orchid\Layouts\Site\Municity;

use Orchid\Screen\Layouts\Listener;
use App\Orchid\Layouts\Site\Municity\MunicityEditLayout;

class MunicityListenerLayout extends Listener
{
    protected $targets = [
        'test',
    ];

    protected $asyncMethod = 'asyncGetRegionId';

    protected function layouts(): array
    {
        return [
            MunicityEditLayout::class,
        ];
    }
}
