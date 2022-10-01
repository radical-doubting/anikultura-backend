<?php

namespace App\Models\Farmland;

use App\Models\Batch\Batch;
use App\Models\User\Farmer\Farmer;
use App\Orchid\Presenters\Farmland\FarmlandPresenter;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;

class Farmland extends Model
{
    use HasFactory, Filterable, Loggable, Searchable;

    protected $fillable = [
        'name',
        'batch_id',
        'type_id',
        'status_id',
        'hectares_size',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'hectares_size',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'hectares_size',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'hectares_size' => 'float',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->name} - {$this->batch->farmschool_name}";
    }

    public function scopeFarmerBelongToFarmland(Builder $query, $farmerId)
    {
        return $query->whereHas('farmers', function ($q) use ($farmerId) {
            $q->whereIn('id', [$farmerId]);
        });
    }

    /**
     * Get the type of this farmland.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(FarmlandType::class);
    }

    /**
     * Get the status of this farmland.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(FarmlandStatus::class);
    }

    /**
     * Get the batch of this farmland.
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    /**
     * Get the watering systems of this farmland.
     */
    public function wateringSystems(): BelongsToMany
    {
        return $this->belongsToMany(WateringSystem::class, 'farmland_watering_systems');
    }

    /**
     * Get the crop buyers of this farmland.
     */
    public function cropBuyers(): BelongsToMany
    {
        return $this->belongsToMany(CropBuyer::class, 'farmland_crop_buyers');
    }

    /**
     * Get the farmer users of this farmland.
     */
    public function farmers(): BelongsToMany
    {
        return $this->belongsToMany(Farmer::class, 'farmland_farmers', 'farmland_id', 'farmer_id');
    }

    public function searchableAs(): string
    {
        return 'farmlands_name_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function presenter(): FarmlandPresenter
    {
        return new FarmlandPresenter($this);
    }
}
