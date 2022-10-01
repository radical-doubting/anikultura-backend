<?php

namespace App\Models\Admin;

use App\Models\User\User;
use App\Orchid\Presenters\AdminPresenter;
use App\Orchid\Presenters\UserPresenter;

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

    public function presenter(): UserPresenter
    {
        return new AdminPresenter($this);
    }
}
