<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['vrchat-cloud-slide.firebaseapp.com', 'vcs.idevs.jp', 'localhost:3000'],
    // 'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    // 'allowedHeaders' => ['Content-Type', 'X-Requested-With'],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
