<?php

namespace App\Models\BigBrother;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class BigBrotherProfile extends Model
{
    use Filterable, HasFactory, AsSource, Loggable;

    protected $fillable = [
        'age',
        'organization_name',
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

    public function user(): MorphOne
    {
        return $this->morphOne(BigBrother::class, 'profile');
    }
}
