<?php

declare(strict_types=1);

namespace App\Models\User;

use Orchid\Platform\Models\Role as BaseModel;

class Role extends BaseModel
{
    /**
     * @var array
     */
    protected $casts = [
        'permissions' => 'array',
    ];

    public static function admin(): Role
    {
        return Role::where('slug', 'admin')
            ->first();
    }

    public static function bigBrother(): Role
    {
        return Role::where('slug', 'big-brother')
            ->first();
    }
}
