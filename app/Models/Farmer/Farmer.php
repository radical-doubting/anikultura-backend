<?php

namespace App\Models\Farmer;

use App\Models\Batch\Batch;
use App\Models\Farmland\Farmland;
use App\Models\User;
use App\Orchid\Presenters\FarmerPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Farmer extends User
{
    public static $profilePath = 'App\Models\Farmer\FarmerProfile';

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('profile_type', self::$profilePath);
        });
    }

    public function scopeFarmerBelongToBatch(Builder $query, $batchId)
    {
        return $query->whereHas('batches', function ($q) use ($batchId) {
            $q->where('id', '=', $batchId);
        });
    }

    public function batches(): BelongsToMany
    {
        return $this->belongsToMany(Batch::class, 'batch_farmers', 'farmer_id', 'batch_id');
    }

    public function farmlands(): BelongsToMany
    {
        return $this->belongsToMany(Farmland::class, 'farmland_farmers', 'farmer_id', 'farmland_id');
    }

    public function presenter()
    {
        return new FarmerPresenter($this);
    }
}
