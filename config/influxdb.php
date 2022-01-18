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
    | InfluxDB Enable Flag
    |--------------------------------------------------------------------------
    |
    | Here InfluxDB metrics can be enabled or not.
    |
    */

    'enabled' => env('INFLUXDB_ENABLED', true),

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
            'url'       => env('INFLUXDB_URL'),
            'token'     => env('INFLUXDB_TOKEN'),
            'bucket'    => env('INFLUXDB_BUCKET'),
            'org'       => env('INFLUXDB_ORG'),
            'verifySSL' => env('INFLUXDB_VERIFY_SSL', false),
            'precision' => env('INFLUXDB_PRECISION', 'ns'),
        ],

    ],

];
