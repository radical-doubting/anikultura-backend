<?php

namespace App\Models\Farmland;

use App\Models\Batch\Batch;
use App\Models\Farmer\Farmer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Farmland extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'batch_id',
        'type_id',
        'status_id',
        'hectares_size',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'hectares_size',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'hectares_size',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'hectares_size' => 'float',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->name} - {$this->batch->farmschool_name}";
    }

    public function scopeFarmerBelongToFarmland(Builder $query, $farmerId)
    {
        return $query->whereHas('farmers', function ($q) use ($farmerId) {
            $q->whereIn('id', [$farmerId]);
        });
    }

    /**
     * Get the type of this farmland.
     */
    public function type()
    {
        return $this->belongsTo(FarmlandType::class);
    }

    /**
     * Get the status of this farmland.
     */
    public function status()
    {
        return $this->belongsTo(FarmlandStatus::class);
    }

    /**
     * Get the batch of this farmland.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    /**
     * Get the watering systems of this farmland.
     */
    public function wateringSystems()
    {
        return $this->belongsToMany(WateringSystem::class, 'farmland_watering_systems');
    }

    /**
     * Get the crop buyers of this farmland.
     */
    public function cropBuyers()
    {
        return $this->belongsToMany(CropBuyer::class, 'farmland_crop_buyers');
    }

    /**
     * Get the farmer users of this farmland.
     */
    public function farmers()
    {
        return $this->belongsToMany(Farmer::class, 'farmland_farmers', 'farmland_id', 'farmer_id');
    }
}
