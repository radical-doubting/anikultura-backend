<?php

namespace App\Helpers;

use Orchid\Support\Facades\Toast;

class ToastHelper
{
    public static function showReferenceDeleteError(string $resource): void
    {
        Toast::error(__(
            'Cannot delete :resource that is still being referenced by other resources.',
            [
                'resource' => __($resource),
            ]
        ));
    }
}
