<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmerAddress extends Model
{
    use HasFactory;

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
}
