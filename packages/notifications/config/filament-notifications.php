<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database notifications
    |--------------------------------------------------------------------------
    |
    | By enabling this feature, your users are able to open a slide-over within
    | the app to view their database notifications.
    |
    */

    'database' => [
        'enabled' => false,
        'trigger' => null,
        'polling_interval' => '30s',
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the general layout of notifications.
    |
    */

    'layout' => [
        'alignment' => [
            'horizontal' => 'right',
            'vertical' => 'top',
        ],
    ],

];