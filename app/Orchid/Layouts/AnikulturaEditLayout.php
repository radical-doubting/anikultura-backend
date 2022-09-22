<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

abstract class AnikulturaEditLayout extends Rows
{
    /**
     * @return string[]|Field[]
     */
    abstract protected function fields(): iterable;
}
