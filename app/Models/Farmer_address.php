<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_number',
        'street',
        'barangay',
        'city',
        'province',
        'region',
        'created_at',
        'updated_at',
    ];
}
