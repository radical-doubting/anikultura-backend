<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmerPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_profile_id',
        'tutorial_done',
    ];

    protected $casts = [
        'tutorial_done' => 'bool',
    ];

    public function farmerProfile(): BelongsTo
    {
        return $this->belongsTo(FarmerProfile::class);
    }
}
