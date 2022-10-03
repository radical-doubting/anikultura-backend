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

    /*
    |--------------------------------------------------------------------------
    | Insights
    |--------------------------------------------------------------------------
    |
    | The insights mode define what model event to generate metrics from. It
    | can be `save` or `create`. It can also be set to `none` to disable
    | insights entirely.
    |
    */

    'insightsMode' => env('ANIKULTURA_INSIGHTS_MODE', 'none'),

    'insightsUrl' => [
        'home' => env('ANIKULTURA_INSIGHTS_HOME_URL', '#'),
        'batch' => env('ANIKULTURA_INSIGHTS_BATCH_URL', '#'),
        'crop' => env('ANIKULTURA_INSIGHTS_CROP_URL', '#'),
        'farmer' => env('ANIKULTURA_INSIGHTS_FARMER_URL', '#'),
        'farmerReport' => env('ANIKULTURA_INSIGHTS_FARMER_REPORT_URL', '#'),
        'farmland' => env('ANIKULTURA_INSIGHTS_FARMLAND_URL', '#'),
        'site' => env('ANIKULTURA_INSIGHTS_SITE_URL', '#'),
    ],
];
