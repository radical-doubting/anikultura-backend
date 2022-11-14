<?php

namespace App\Models\Site;

use App\Traits\Loggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;

/**
 * @property string $slug
 */
class Region extends Model
{
    use Filterable, HasFactory, Sluggable, Loggable;

    protected $fillable = [
        'name',
        'short_name',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'slug',
        'short_name',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'slug',
        'short_name',
        'updated_at',
        'created_at',
    ];

    /**
     * Get the province in regions.
     */
    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }

    /**
     * Get full name of regions.
     */
    public function getFullNameAttribute()
    {
        return "{$this->short_name} - {$this->name}";
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
                'source' => 'short_name',
            ],
        ];
    }
}
