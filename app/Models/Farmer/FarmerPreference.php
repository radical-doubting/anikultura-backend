<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_profile_id',
        'tutorial_done',
        'language',
    ];
}
