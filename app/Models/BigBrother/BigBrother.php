<?php

namespace App\Models\BigBrother;

use App\Models\Batch\Batch;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class BigBrother extends User
{
    public static $profilePath = 'App\Models\BigBrother\BigBrotherProfile';

    /**
     * The database table used by the model.
     *
     * @var string
     */
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

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_farmers', 'farmer_id', 'batch_id');
    }
}
