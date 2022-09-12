<?php

namespace App\Collectors;

use Arquivei\LaravelPrometheusExporter\CollectorInterface;
use Arquivei\LaravelPrometheusExporter\PrometheusExporter;

class FarmerCollector implements CollectorInterface
{
    public function getName(): string
    {
        return 'farmers';
    }

    public function registerMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerGauge(
            'farmer_total',
            'The total number of farmers.',
            ['region', 'province', 'municity']
        );

        $exporter->registerGauge(
            'farmer_report_total',
            'The total number of farmer reports.',
            ['crop', 'seed_stage', 'region', 'province', 'municity']
        );

        $exporter->registerGauge(
            'farmer_report_estimated_yield_grams',
            'The estimated yield in grams from farmer reports.',
            ['crop', 'region', 'province', 'municity', 'yield_date_earliest', 'yield_date_latest']
        );
    }

    public function collect(): void
    {
    }
}
