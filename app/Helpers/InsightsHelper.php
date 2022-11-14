<?php

namespace App\Helpers;

use Orchid\Screen\Actions\Link;

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

    public static function makeLink(string $resource = 'home'): Link
    {
        $link = config("anikultura.insightsUrl.$resource");
        $isDefault = $link === '#';

        return Link::make(__('View Insights'))
            ->icon('bulb')
            ->href($link)
            ->target('_blank')
            ->canSee(! $isDefault);
    }
}
