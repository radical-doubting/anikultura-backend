<?php

namespace App\Models\User\Farmer;

use App\Models\Site\Region;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmerAddress extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'house_number',
        'street',
        'barangay',
        'municity',
        'province',
        'region_id',
        'farmer_profile_id',
    ];

    public function farmerProfile(): BelongsTo
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
