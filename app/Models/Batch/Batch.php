<?php

namespace App\Models\Batch;

use App\Models\Farmer\Farmer;
use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use Chelout\RelationshipEvents\Concerns\HasBelongsToManyEvents;
use Chelout\RelationshipEvents\Traits\HasRelationshipObservables;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Batch extends Model
{
    use Filterable, HasFactory, HasBelongsToManyEvents, HasRelationshipObservables, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farmschool_name',
        'assigned_site',
        'number_seeds_distributed',
        'region_id',
        'province_id',
        'municity_id',
        'barangay',
        'farmer_names,',

    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'farmschool_name',
        'updated_at',
        'created_at',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'farmschool_name',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function municity()
    {
        return $this->belongsTo(Municity::class);
    }

    public function farmers()
    {
        return $this->belongsToMany(Farmer::class, 'batch_farmers', 'batch_id', 'farmer_id');
    }

    public function seedAllocations()
    {
        return $this->hasMany(BatchSeedAllocation::class);
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
                'source' => 'farmschool_name',
            ],
        ];
    }
}
