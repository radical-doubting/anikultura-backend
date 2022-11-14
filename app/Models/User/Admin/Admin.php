<?php

namespace App\Models\User\Admin;

use App\Models\User\User;
use App\Orchid\Presenters\User\AdminPresenter;
use App\Orchid\Presenters\User\UserPresenter;

class Admin extends User
{
    public const PROFILE_PATH = 'App\Models\User\Admin\AdminProfile';

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('profile_type', self::PROFILE_PATH);
        });
    }

    public function presenter(): UserPresenter
    {
        return new AdminPresenter($this);
    }
}
