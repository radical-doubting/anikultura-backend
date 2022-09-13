<?php

namespace App\Collectors;

use Arquivei\LaravelPrometheusExporter\CollectorInterface;
use Arquivei\LaravelPrometheusExporter\PrometheusExporter;

class FarmlandCollector implements CollectorInterface
{
    public function getName(): string
    {
        return 'farmlands';
    }

    public function registerMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerGauge(
            'farmland_total',
            'The total number of farmlands.',
            ['type', 'status', 'region', 'province', 'municity']
        );

        $exporter->registerGauge(
            'farmland_hectares',
            'The total hectares of farmlands.',
            ['type', 'status', 'region', 'province', 'municity']
        );
    }

    public function collect(): void
    {
    }
}
