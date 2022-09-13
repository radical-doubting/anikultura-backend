<?php

namespace App\Collectors;

use Arquivei\LaravelPrometheusExporter\CollectorInterface;
use Arquivei\LaravelPrometheusExporter\PrometheusExporter;

class SiteCollector implements CollectorInterface
{
    public function getName(): string
    {
        return 'sites';
    }

    public function registerMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerGauge(
            'municipality_city_total',
            'The total number of site municipalities and cities.',
            ['region', 'province']
        );

        $exporter->registerGauge(
            'province_total',
            'The total number of site provinces.',
            ['region']
        );

        $exporter->registerGauge(
            'region_total',
            'The total number of site regions.'
        );
    }

    public function collect(): void
    {
    }
}
