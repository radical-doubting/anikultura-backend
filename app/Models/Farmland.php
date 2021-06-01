<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmland extends Model
{
    public $table = 'farmer_profile';

    use HasFactory;

    protected $fillable = [
        'farmland_type',
        'farm_size',
        'watering_system',
        'crop_buyer',
        'updated_at',
    ];
}
