<?php

namespace App\Collectors;

use Arquivei\LaravelPrometheusExporter\CollectorInterface;
use Arquivei\LaravelPrometheusExporter\PrometheusExporter;

class CropCollector implements CollectorInterface
{
    public function getName(): string
    {
        return 'crops';
    }

    public function registerMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerGauge(
            'crop_profit_per_kg_pesos',
            'The total profit per kilogram of crops.',
            ['crop']
        );

        $exporter->registerGauge(
            'crop_net_profit_cost_ratio',
            'The total net profit cost ratio of crops.',
            ['crop']
        );
    }

    public function collect(): void
    {
    }
}
