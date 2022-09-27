<?php

namespace App\Helpers;

class InsightsHelper
{
    public static function incrementGauge(string $name, array $labels = [], float $increment = 1): void
    {
        app('prometheus')->getGauge($name)->incBy($increment, $labels);
    }

    public static function decrementGauge(string $name, array $labels = [], float $decrement = 1): void
    {
        app('prometheus')->getGauge($name)->decBy($decrement, $labels);
    }
}
