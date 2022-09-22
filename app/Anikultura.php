<?php

namespace App;

use Illuminate\Support\Facades\Config;

class Anikultura
{
    public function isHeadless(): bool
    {
        $isHeadlessValue = Config::get('anikultura.isHeadless');

        return filter_var($isHeadlessValue, FILTER_VALIDATE_BOOLEAN);
    }
}
