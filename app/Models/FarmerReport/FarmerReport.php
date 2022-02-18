<?php

namespace App\Models\FarmerReport;

use App\Models\Crop\Crop;
use App\Models\Crop\SeedStage;
use App\Models\Farmer\Farmer;
use App\Models\Farmland\Farmland;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;

class FarmerReport extends Model
{
    use Filterable, HasFactory, Attachable;

    protected $fillable = [
        'reported_by',
        'seed_stage_id',
        'farmland_id',
        'crop_id',
        'verified',
        'verified_by',
        'volume_kg',
        'image',
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
        return $this->belongsTo(Farmer::class, 'reported_by');
    }

    public function image()
    {
        return $this->hasOne(Attachment::class, 'id', 'image')->withDefault();
    }

    public function seedStage()
    {
        return $this->belongsTo(SeedStage::class);
    }

    public function isPlanted()
    {
        $plantedId = (int) Cache::rememberForever('seed_stages:planted_id', function () {
            return $this->getSeedStageFromSlug('seeds-planted');
        });

        return $this->seed_stage_id === $plantedId;
    }

    public function isHarvested()
    {
        $cropHarvestedId = (int) Cache::rememberForever('seed_stages:crops_harvested_id', function () {
            return $this->getSeedStageFromSlug('crops-harvested');
        });

        return $this->seed_stage_id === $cropHarvestedId;
    }

    private function getSeedStageFromSlug(string $slug)
    {
        return SeedStage::where('slug', $slug)
            ->first()
            ->id;
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
