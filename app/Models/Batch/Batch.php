<?php

namespace App\Models\Batch;

use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Batch extends Model
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
        'region_id',
        'province_id',
        'municity_id',
        'barangay',
        'farmer_names,'
        
    ];

    
    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'assigned_farmschool_name',
        'updated_at',
        'created_at',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'assigned_farmschool_name',
        
    ];

    /*
    protected $casts = [
        'farmer_names' => 'array'
    ];*/

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function municity()
    {
        return $this->belongsTo(Municity::class);
    }

    public function farmers()
    {
        return $this->belongsToMany(User::class, 'batch_farmers', 'batch_id', 'farmer_id');
    }
}
