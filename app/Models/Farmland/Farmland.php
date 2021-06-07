<?php

namespace App\Models\Farmland;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Farmland extends Model
{
    public $table = 'farmland';

    use HasFactory, Filterable;

    protected $fillable = [
        'hectares_size',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function farmer_profile()
    {
        return $this->hasMany(farmer_profile::class, 'foreign_key');
    }

}
