<?php

namespace App\Models\Site;

use App\Traits\Loggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;

/**
 * @property string $slug
 */
class Province extends Model
{
    use Filterable, HasFactory, Sluggable, Loggable;

    protected $fillable = [
        'name',
        'region_id',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'updated_at',
        'created_at',
    ];

    public function scopeOfRegion(Builder $query, Region $region): Builder
    {
        return $query->whereHas(
            'region',
            fn (Builder $query) => $query->where('region_id', '=', $region->id)
        );
    }

    /**
     * Get the region that owns this province.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
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
