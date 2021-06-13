<?php

namespace App\Models;

use App\Models\Farmland\Farmland;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class FarmerReport extends Model
{
    use Filterable, HasFactory;

    protected $fillable = [
        'farmer_id',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'volume',
    ];

    protected $allowedFilters = [
        'id',
        'farmer_profile_id',
    ];

    protected $allowedSorts = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class);
    }

    public function seed_stage()
    {
        return $this->belongsTo(SeedStage::class);
    }

    public function farmland()
    {
        return $this->belongsTo(Farmland::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
