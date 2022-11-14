<?php

namespace App\Models\User\Admin;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class AdminProfile extends Model
{
    use Filterable, HasFactory, AsSource, Loggable;

    protected $fillable = [
        'age',
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

    public function user()
    {
        return $this->morphOne(Admin::class, 'profile');
    }
}
