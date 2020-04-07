<?php

return [
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_methods' => ['*'],

    'allowed_headers' => [
        'Authorization', 'Content-Type', 'If-Match', 'If-Modified-Since', 'If-None-Match', 'If-Unmodified-Since',
        'X-Requested-With', 'X-CSRF-TOKEN', 'X-Token'
    ],

    'exposed_headers' => ['X-Token', 'X-Uuid'],

    'max_age' => 0,

    'supports_credentials' => true,
];
