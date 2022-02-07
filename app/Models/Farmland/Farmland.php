<?php

namespace App\Models\Farmland;

use App\Models\Farmer\Farmer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Farmland extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
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
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'updated_at',
        'created_at',
    ];

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
