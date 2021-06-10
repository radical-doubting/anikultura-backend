<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function farmer_profile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }
}
