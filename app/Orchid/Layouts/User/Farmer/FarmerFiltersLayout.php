<?php

namespace App\Orchid\Layouts\User\Farmer;

use App\Orchid\Filters\User\UserNameFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class FarmerFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            UserNameFilter::class,
        ];
    }
}
