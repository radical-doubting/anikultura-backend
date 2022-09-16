<?php

namespace App\Orchid\Layouts\User;

use App\Orchid\Filters\RoleFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class UserFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): array
    {
        return [
            RoleFilter::class,
        ];
    }
}
