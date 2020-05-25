<?php

return [
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_methods' => ['*'],

    'allowed_headers' => [
        'Authorization', 'Content-Type', 'If-Match', 'If-Modified-Since', 'If-None-Match', 'If-Unmodified-Since',
        'X-Requested-With', 'X-CSRF-TOKEN', 'X-Token', 'X-Recaller-Sign'
    ],

    'exposed_headers' => [
        'Content-Disposition',
        'X-Token', 'X-Uuid', 'X-Recaller-Sign'
    ],

    'max_age' => 0,

    'supports_credentials' => true,
];
