<?php

namespace App\Orchid\Layouts;

use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

abstract class AnikulturaFilterLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    abstract public function filters(): iterable;
}
