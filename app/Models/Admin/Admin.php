<?php

namespace App\Models\Admin;

use App\Models\User;

class Admin extends User
{
    public static $profilePath = 'App\Models\Admin\AdminProfile';

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('profile_type', self::$profilePath);
        });
    }
}
