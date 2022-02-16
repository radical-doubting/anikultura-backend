<?php

namespace App\Models\Admin;

use App\Models\User;

class Admin extends User
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public static function boot()
    {
        parent::boot();
    }
}
