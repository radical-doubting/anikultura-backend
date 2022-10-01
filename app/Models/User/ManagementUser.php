<?php

namespace App\Models\User;

use App\Models\User\Admin\Admin;
use App\Models\User\BigBrother\BigBrother;

class ManagementUser extends User
{
    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('profile_type', BigBrother::PROFILE_PATH);
            $query->orWhere('profile_type', Admin::$profilePath);
        });
    }
}
