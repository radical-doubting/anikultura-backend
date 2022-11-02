<?php

namespace App\Orchid\Layouts\Farmland;

use Orchid\Screen\Layouts\Listener;

class FarmlandEditMemberListener extends Listener
{
    protected $targets = ['farmland.batch_id'];

    protected $asyncMethod = 'asyncRetrieveBatch';

    protected function layouts(): array
    {
        return [
            FarmlandEditMemberLayout::class,
        ];
    }
}
