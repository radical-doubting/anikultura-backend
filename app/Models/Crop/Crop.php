<?php

namespace App\Models\Crop;

use App\Actions\Crop\CalculateNetProfitCostRatio;
use App\Actions\Crop\CalculateNetReturns;
use App\Actions\Crop\CalculateProfitPerKilogram;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Crop extends Model
{
    use Filterable, HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'group',
        'name',
        'variety',
        'gross_returns_per_ha',
        'total_costs_per_ha',
        'production_cost_per_kg',
        'farmgate_price_per_kg',
        'yield_per_ha',
        'maturity_lower_bound',
        'maturity_upper_bound',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'group',
        'name',
        'variety',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'group',
        'name',
        'variety',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $crop) {
            $crop->profit_per_kg = CalculateProfitPerKilogram::run($crop);
            $crop->net_returns_per_ha = CalculateNetReturns::run($crop);
            $crop->net_profit_cost_ratio = CalculateNetProfitCostRatio::run($crop);
        });
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
