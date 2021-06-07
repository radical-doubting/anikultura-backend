<?php

namespace App\Models\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Farmers extends Model
{
    use Filterable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farmer_names',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'updated_at',
        'created_at',
    ];

    /**
     * Get the region that owns this province.
     */
    public function farmers()
    {
        return $this->belongsTo(Farmers::class);
    }

    protected $casts = [
        'farmer_names' => 'array'
    ];
}
