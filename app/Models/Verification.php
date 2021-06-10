<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
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

    public function farmer_profile()
    {
        return $this->belongsTo(Farmer_profile::class, 'foreign_key');
    }
}
