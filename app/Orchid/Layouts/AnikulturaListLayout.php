<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;

abstract class AnikulturaListLayout extends Table
{
    protected function striped(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    abstract protected function columns(): iterable;
}
