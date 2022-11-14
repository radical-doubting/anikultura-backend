<?php

namespace App\Models\User\BigBrother;

use App\Models\Batch\Batch;
use App\Models\User\User;
use App\Orchid\Presenters\User\BigBrotherPresenter;
use App\Orchid\Presenters\User\UserPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BigBrother extends User
{
    public const PROFILE_PATH = 'App\Models\User\BigBrother\BigBrotherProfile';

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('profile_type', self::PROFILE_PATH);
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

    public function presenter(): UserPresenter
    {
        return new BigBrotherPresenter($this);
    }
}
