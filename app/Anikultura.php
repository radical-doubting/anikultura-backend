<?php

namespace App;

use App\Enums\InsightsMode;
use Illuminate\Support\Facades\Config;

class Anikultura
{
    public function isHeadless(): bool
    {
        $isHeadlessValue = Config::get('anikultura.isHeadless');

        return filter_var($isHeadlessValue, FILTER_VALIDATE_BOOLEAN);
    }

    public function isInsightsEnabled(): bool
    {
        return $this->getInsightsMode() !== InsightsMode::NONE;
    }

    public function getInsightsMode(): InsightsMode
    {
        $insightsModeValue = Config::get('anikultura.insightsMode');

        return InsightsMode::from($insightsModeValue);
    }
}
