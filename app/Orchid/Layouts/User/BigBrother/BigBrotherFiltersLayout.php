<?php

namespace App\Orchid\Layouts\User\BigBrother;

use App\Orchid\Filters\User\UserNameFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class BigBrotherFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            UserNameFilter::class,
        ];
    }
}
