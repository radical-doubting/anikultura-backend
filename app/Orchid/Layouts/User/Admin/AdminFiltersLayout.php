<?php

namespace App\Orchid\Layouts\User\Admin;

use App\Orchid\Filters\User\UserNameFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class AdminFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            UserNameFilter::class,
        ];
    }
}
