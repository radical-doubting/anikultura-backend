<?php

namespace App\Models\FarmerReport;

use App\Models\Crop\Crop;
use App\Models\Crop\SeedStage;
use App\Models\Farmer\Farmer;
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
        return $this->belongsTo(Farmer::class);
    }

    public function seedStage()
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
