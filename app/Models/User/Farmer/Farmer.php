<?php

namespace App\Models\User\Farmer;

use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use App\Models\User\User;
use App\Orchid\Presenters\User\FarmerPresenter;
use App\Orchid\Presenters\User\UserPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farmer extends User
{
    public const PROFILE_PATH = 'App\Models\User\Farmer\FarmerProfile';

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('profile_type', self::PROFILE_PATH);
        });
    }

    public function scopeOfBatch(Builder $query, Batch $batch): Builder
    {
        return $query->whereHas(
            'batches',
            fn (Builder $query) => $query->where('id', '=', $batch->id)
        );
    }

    public function batches(): BelongsToMany
    {
        return $this->belongsToMany(Batch::class, 'batch_farmers', 'farmer_id', 'batch_id');
    }

    public function farmlands(): BelongsToMany
    {
        return $this->belongsToMany(Farmland::class, 'farmland_farmers', 'farmer_id', 'farmland_id');
    }

    public function farmerReports(): HasMany
    {
        return $this->hasMany(FarmerReport::class, 'reported_by');
    }

    public function seedAllocations(): HasMany
    {
        return $this->hasMany(BatchSeedAllocation::class, 'farmer_id');
    }

    public function presenter(): UserPresenter
    {
        return new FarmerPresenter($this);
    }
}
