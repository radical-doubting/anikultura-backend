<?php

namespace App\Providers;

use Arquivei\LaravelPrometheusExporter\PrometheusExporter;
use Arquivei\LaravelPrometheusExporter\PrometheusServiceProvider as ServiceProvider;

class PrometheusServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        $exporter = app('prometheus');

        $this->addSiteMetrics($exporter);
        $this->addBatchMetrics($exporter);
        $this->addFarmlandMetrics($exporter);
        $this->addCropMetrics($exporter);
        $this->addFarmerMetrics($exporter);
    }

    private function addSiteMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerCounter(
            'municipality_city_total',
            'The total number of site municipalities and cities.',
            ['region', 'province']
        );

        $exporter->registerCounter(
            'province_total',
            'The total number of site provinces.',
            ['region']
        );

        $exporter->registerCounter(
            'region_total',
            'The total number of site regions.'
        );
    }

    private function addBatchMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerCounter(
            'batch_total',
            'The total number of batches.',
            ['region', 'province', 'municity']
        );
    }

    private function addFarmlandMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerCounter(
            'farmland_total',
            'The total number of farmlands.',
            ['type', 'status', 'region', 'province', 'municity']
        );

        $exporter->registerCounter(
            'farmland_hectares',
            'The total hectares of farmlands.',
            ['type', 'status', 'region', 'province', 'municity']
        );
    }

    private function addCropMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerCounter(
            'crop_profit_per_kg_pesos',
            'The total profit per kilogram of crops.',
            ['crop']
        );

        $exporter->registerCounter(
            'crop_net_profit_cost_ratio',
            'The total net profit cost ratio of crops.',
            ['crop']
        );

        $exporter->registerCounter(
            'seed_allocation_total',
            'The total number of seed allocations.',
            ['crop', 'region', 'province', 'municity']
        );
    }

    private function addFarmerMetrics(PrometheusExporter $exporter): void
    {
        $exporter->registerCounter(
            'farmer_total',
            'The total number of farmers.',
            ['region', 'province', 'municity']
        );

        $exporter->registerCounter(
            'farmer_report_total',
            'The total number of farmer reports.',
            ['crop', 'seed_stage', 'region', 'province', 'municity']
        );
    }
}
