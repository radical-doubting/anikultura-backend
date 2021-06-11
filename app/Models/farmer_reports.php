<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class farmer_reports extends Model
{
    protected $fillable = [
        'farmer_profiles_id',
        'seed_stages_id',
        'farmland_id',
        'crop_id',
        'volume',
    ];

    protected $allowedFilters = [
        'id',
        'farmer_profiles_id',
    ];

    protected $allowedSorts = [
        'id',
        'updated_at',
        'created_at',
    ];
}
