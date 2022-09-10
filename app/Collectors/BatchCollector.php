<?php

namespace App\Collectors;

use Arquivei\LaravelPrometheusExporter\CollectorInterface;
use Arquivei\LaravelPrometheusExporter\PrometheusExporter;

class BatchCollector implements CollectorInterface
{
    public function getName(): string
    {
        return 'batches';
    }

    public function registerMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerGauge(
            'batch_total',
            'The total number of batches.',
            ['region', 'province', 'municity']
        );
    }

    public function collect(): void
    {
    }
}
