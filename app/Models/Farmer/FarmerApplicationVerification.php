<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerApplicationVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'verified_by',
        'position',
        'office',
        'contact_number',
        'mode_of_application',
        'created_at',
        'updated_at',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class, 'foreign_key');
    }
}
