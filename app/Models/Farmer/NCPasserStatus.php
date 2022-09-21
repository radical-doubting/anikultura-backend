<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Model;

class NCPasserStatus extends Model
{
    protected $table = 'nc_passer_statuses';

    protected $fillable = [
        'name',
    ];
}
