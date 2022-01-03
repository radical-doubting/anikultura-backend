<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'contact_number',
        'username',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    protected $with = [
        'profile'
    ];

    /**
     * Returns users with farmer profiles.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeFarmer(Builder $query)
    {
        return $query->where('profile_type', 'App\Models\Farmer\FarmerProfile');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name} ({$this->name})";
    }

    public function profile()
    {
        return $this->morphTo('');
    }

    public function hasFarmerProfile()
    {
        return $this->profile_type === 'App\Models\Farmer\FarmerProfile';
    }
}
