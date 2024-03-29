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
class Municity extends Model
{
    use Filterable, HasFactory, Sluggable, Loggable;

    protected $fillable = [
        'name',
        'province_id',
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
        'email',
        'updated_at',
        'created_at',
    ];

    public function scopeOfProvince(Builder $query, Province $province): Builder
    {
        return $query->whereHas(
            'province',
            fn (Builder $query) => $query->where('province_id', '=', $province->id)
        );
    }

    /**
     * Get the province that owns this municity.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the region that owns this municity.
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

    /**
     * Get the region that owns the municity province
     */
    public function regionBelongToProvince($province_id)
    {
        $this->province_id = $province_id;

        $regionIdinJSON = Region::whereHas('provinces', function ($query) {
            $query->where('id', '=', $this->province_id);
        })->get('id');

        $regionId = json_decode($regionIdinJSON, true);

        return $regionId[0]['id'];
    }
}
