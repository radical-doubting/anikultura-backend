<?php

namespace App\Providers;

use Arquivei\LaravelPrometheusExporter\PrometheusServiceProvider as ServiceProvider;

class PrometheusServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        parent::boot();

        $exporter = app('prometheus');
    }
}
