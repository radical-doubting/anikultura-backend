<?php

namespace App\Models\Farmland;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmland extends Model
{
    public $table = 'farmland';

    use HasFactory;

    protected $fillable = [
        'farm_size',
        'crop_buyer',
        'created_at',
        'updated_at',
    ];

    public function farmer_profile()
    {
        return $this->hasMany(farmer_profile::class, 'foreign_key');
    }
}
