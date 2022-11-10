<?php

namespace App\Models\Farmland;

use App\Models\Batch\Batch;
use App\Models\Site\Municity;
use App\Models\User\Farmer\Farmer;
use App\Models\User\User;
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

    public function getFullNameAttribute(): string
    {
        $batch = $this->batch;
        $farmlandSchoolName = __('No batch');

        if (! is_null($batch)) {
            $farmlandSchoolName = $batch->farmschool_name;
        }

        return "{$this->name} - {$farmlandSchoolName}";
    }

    public function scopeOfFarmer(Builder $query, Farmer $farmer): Builder
    {
        return $query->whereHas(
            'farmers',
            fn (Builder $query) => $query->whereIn('id', [$farmer->id])
        );
    }

    public function scopeOfBigBrother(Builder $query, User $user): Builder
    {
        $nestedQuery = fn (Builder $query) => $query->where(
            'big_brother_id',
            '=',
            $user->id
        );

        return $query->whereHas(
            'batch',
            fn (Builder $query) => $query->whereHas('bigBrothers', $nestedQuery)
        );
    }

    public function scopeOfMunicity(Builder $query, Municity $municity): Builder
    {
        return $query->whereHas(
            'batch',
            fn (Builder $query) => $query->where(
                'municity_id',
                '=',
                $municity->id
            )
        );
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
