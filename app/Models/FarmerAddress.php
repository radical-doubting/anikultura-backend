<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_number',
        'street',
        'barangay',
        'city',
        'created_at',
        'updated_at',
    ];

    public function farmer_profile()
    {
        return $this->belongsTo(Farmer_profile::class, 'foreign_key');
    }
}
