<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Program Names
    |--------------------------------------------------------------------------
    |
    | Here you may specify the agricultural program names that the platform will
    | use on its management dashboard.
    |
    */

    'programFullName' => env('ANIKULTURA_PROGRAM_FULL_NAME', 'Anikultura Program'),
    'programDisplayName' => env('ANIKULTURA_PROGRAM_DISPLAY_NAME', 'Anikultura Program'),

    /*
    |--------------------------------------------------------------------------
    | Grafana URL
    |--------------------------------------------------------------------------
    |
    | Here you may specify the Grafana URL that the platform will use on the
    | dashboard home page.
    |
    */

    'grafanaUrl' => env('ANIKULTURA_GRAFANA_URL', 'http://example.com'),

    /*
    |--------------------------------------------------------------------------
    | Organization Details
    |--------------------------------------------------------------------------
    |
    | Here you may specify the organization details that the platform will
    | use on its management dashboard.
    |
    */
    'organizationName' => env('ANIKULTURA_ORGANIZATION_NAME', 'Anikultura Organization'),
    'organizationUrl' => env('ANIKULTURA_ORGANIZATION_URL', 'http://example.com'),

    /*
    |--------------------------------------------------------------------------
    | Headless
    |--------------------------------------------------------------------------
    |
    | Here you may specify whether the platform will not serve an management
    | dashboard.
    |
    */
    'isHeadless' => env('ANIKULTURA_HEADLESS', false),
];
