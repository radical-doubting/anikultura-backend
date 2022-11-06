<?php

namespace App\Providers;

use App\Models\Batch\Batch;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use App\Policies\BatchPolicy;
use App\Policies\FarmerReportPolicy;
use App\Policies\FarmlandPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Batch::class => BatchPolicy::class,
        Farmland::class => FarmlandPolicy::class,
        FarmerReport::class => FarmerReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
