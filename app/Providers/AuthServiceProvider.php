<?php

namespace App\Providers;

use App\Models\Batch\Batch;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Farmer\Farmer;
use App\Policies\BatchPolicy;
use App\Policies\FarmerReportPolicy;
use App\Policies\FarmlandPolicy;
use App\Policies\Site\MunicityPolicy;
use App\Policies\Site\ProvincePolicy;
use App\Policies\Site\RegionPolicy;
use App\Policies\User\AdminPolicy;
use App\Policies\User\BigBrotherPolicy;
use App\Policies\User\FarmerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Region::class => RegionPolicy::class,
        Province::class => ProvincePolicy::class,
        Municity::class => MunicityPolicy::class,
        Batch::class => BatchPolicy::class,
        Farmland::class => FarmlandPolicy::class,
        FarmerReport::class => FarmerReportPolicy::class,
        Farmer::class => FarmerPolicy::class,
        BigBrother::class => BigBrotherPolicy::class,
        Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
