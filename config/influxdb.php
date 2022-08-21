<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => env('INFLUXDB_CONNECTION', 'main'),

    /*
    |--------------------------------------------------------------------------
    | InfluxDB Enable Flags
    |--------------------------------------------------------------------------
    |
    | Here InfluxDB metrics can be enabled or not. The observer mode could also
    | be defined to `save` or `create`.
    |
    */

    'enabled' => env('INFLUXDB_ENABLED', true),
    'observerMode' => env('INFLUXDB_OBSERVER_MODE', 'save'),

    /*
    |--------------------------------------------------------------------------
    | InfluxDB Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application.
    |
    */

    'connections' => [

        'main' => [
            'url' => env('INFLUXDB_URL'),
            'token' => env('INFLUXDB_TOKEN'),
            'bucket' => env('INFLUXDB_BUCKET'),
            'org' => env('INFLUXDB_ORG'),
            'verifySSL' => env('INFLUXDB_VERIFY_SSL', false),
            'precision' => env('INFLUXDB_PRECISION', 'ns'),
        ],

    ],

];
