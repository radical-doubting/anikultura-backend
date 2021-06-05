<?php

namespace App\Models\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Batches extends Model
{
    use Filterable, HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assigned_farmschool_name',
        'assigned_site',
        'number_seeds_distributed',
        'farmer_names',
    ];

    
    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'assigned_farmschool_name',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'assigned_farmschool_name',
        'assigned_sites',
        'number_seeds_distributed',
        'farmer_names',
    ];
}
